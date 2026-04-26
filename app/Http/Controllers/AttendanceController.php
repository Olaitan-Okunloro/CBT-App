<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use App\Models\TeacherSubject;
use App\Models\Attendance;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    // Show scanner page
    public function scan()
    {
        return view('teacher.attendance.scan');
    }

    // Handle scan result
    public function mark(Request $request)
    {
        try {

            $student = \App\Models\StudentDetail::find(
                $request->student_id
            );

            if (!$student) {
                return response()->json([
                    'message' => 'Student not found'
                ], 404);
            }

            $now = now();

            $recent = Attendance::where(
                    'student_details_id',
                    $student->id
                )
                ->where(
                    'created_at',
                    '>=',
                    $now->copy()->subMinutes(10)
                )
                ->first();

            if ($recent) {
                return response()->json([
                    'message' =>
                    'Attendance already marked within last 10 minutes'
                ]);
            }

            $today = now()->toDateString();

            $status =
                now()->format('H:i:s') > '08:00:00'
                ? 'late'
                : 'checked in';

            $attendance = Attendance::where(
                    'student_details_id',
                    $student->id
                )
                ->where('date', $today)
                ->first();

            if (!$attendance) {

                Attendance::create([
                    'student_details_id' => $student->id,
                    'date' => $today,
                    'check_in_time' => now()->format('H:i:s'),
                    'status' => $status,
                    'created_by' => auth()->id()
                ]);

                $this->sendParentMail($student, $status);

                return response()->json([
                    'message' =>
                    ($student->user->name ?? 'Student')
                    . ' checked in'
                ]);
            }

            if (!$attendance->check_out_time) {

                $attendance->update([
                        'check_out_time' =>
                            now()->format('H:i:s')
                    ]);

                    $this->sendParentMail($student, 'checked out');

                    return response()->json([
                        'message' =>
                        ($student->user->name ?? 'Student')
                        . ' checked out'
                    ]);
            }

            \App\Models\ActivityLog::create([
                    'user_id' => auth()->id(),
                    'activity' => $student->user->name . ' attendance marked'
                ]);

            return response()->json([
                'message' =>
                'Attendance already completed today'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // send mail to parent 
    private function sendParentMail($student, $status)
    {
        try {

            if (
                !$student ||
                $student->email_sub != 1 ||
                empty($student->guardian_email)
            ) {
                return;
            }

            $studentName =
                optional($student->user)->name ?? 'Student';

            $time = now()->format('g:i A');

            $date = now()->format('d M Y');

            if ($status == 'late') {

                $title = 'Late Attendance Alert';

                $body =
                    "{$studentName} checked in late at {$time}.";

                $color = '#dc3545';

            } elseif ($status == 'checked in') {

                $title = 'Attendance Check-In';

                $body =
                    "{$studentName} checked in successfully at {$time}.";

                $color = '#198754';

            } else {

                $title = 'Attendance Check-Out';

                $body =
                    "{$studentName} checked out at {$time}.";

                $color = '#0d6efd';
            }

            $html = "
            <div style='font-family:Arial;padding:20px;background:#f8f9fa'>
                <div style='max-width:600px;margin:auto;background:white;border-radius:10px;padding:25px'>
                    <h2 style='color:{$color};margin-bottom:15px;'>{$title}</h2>

                    <p>Hello Parent/Guardian,</p>

                    <p style='font-size:16px;'>{$body}</p>

                    <p>Date: <strong>{$date}</strong></p>

                    <hr>

                    <p style='color:#666;font-size:13px;'>
                        This is an automated notification from the school attendance system.
                    </p>
                </div>
            </div>";

            \Mail::html($html, function ($mail) use ($student, $title) {

                $mail->to($student->guardian_email)
                    ->subject($title);

            });

        } catch (\Exception $e) {

            \Log::error(
                'Attendance mail failed: ' . $e->getMessage()
            );
        }
    }

    public function dashboard()
    {
        $user  = auth()->user();
        $today = now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */
        if ($user->role == 'admin') {

            $total = \App\Models\StudentDetail::count();

            $present = \App\Models\Attendance::where('date', $today)->count();

            $late = \App\Models\Attendance::where('date', $today)
                ->where('status', 'late')
                ->count();

            $absent = $total - $present;

            $records = \App\Models\Attendance::with(['student.user'])
                ->where('date', $today)
                ->latest()
                ->paginate(10);
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHER
        |--------------------------------------------------------------------------
        */
        else {

            // Step 1: teacher gets school_classes ids
            $schoolClassIds = \App\Models\TeacherSubject::where('teacher_id', $user->id)
                ->pluck('class_id');

            // Step 2: convert school_classes.id -> class_level_id
            $classLevelIds = \App\Models\SchoolClass::whereIn('id', $schoolClassIds)
                ->pluck('class_level_id');

            // Total students
            $total = \App\Models\StudentDetail::whereIn('class_id', $classLevelIds)
                ->count();

            // Present
            $present = \App\Models\Attendance::where('date', $today)
                ->whereHas('student', function ($q) use ($classLevelIds) {
                    $q->whereIn('class_id', $classLevelIds);
                })
                ->count();

            // Late
            $late = \App\Models\Attendance::where('date', $today)
                ->where('status', 'late')
                ->whereHas('student', function ($q) use ($classLevelIds) {
                    $q->whereIn('class_id', $classLevelIds);
                })
                ->count();

            $absent = $total - $present;

            // Records
            $records = \App\Models\Attendance::with(['student.user'])
                ->where('date', $today)
                ->whereHas('student', function ($q) use ($classLevelIds) {
                    $q->whereIn('class_id', $classLevelIds);
                })
                ->latest()
                ->paginate(10);
        }

        return view('teacher.attendance.dashboard', compact(
            'total',
            'present',
            'late',
            'absent',
            'records'
        ));
    }

    public function pdf()
    {
        $today = now()->toDateString();

        $records = \App\Models\Attendance::with('student')
            ->where('date', $today)
            ->get();

        $pdf = Pdf::loadView('teacher.attendance.pdf', compact('records', 'today'));

        return $pdf->download('attendance-report.pdf');
    }

    // teacher's dashboard
    public function faceRegisterForm($id)
    {
        $student = \App\Models\StudentDetail::with('user')->findOrFail($id);

        return view('teacher.attendance.face-register', compact('student'));
    }

    public function saveFace(Request $request, $id)
    {
        $student = \App\Models\StudentDetail::findOrFail($id);

        $request->validate([
            'image' => 'required',
            'descriptor' => 'required'
        ]);

        // Save image
        $image = $request->image;

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = 'faces/' . time() . '_' . $id . '.png';

        \Storage::disk('public')->put($imageName, base64_decode($image));

        // Save DB
        $student->update([
            'face_photo' => $imageName,
            'face_descriptor' => $request->descriptor
        ]);

        return redirect()->back()->with('success', 'Face registered successfully');
    }

    public function faceScan()
    {
        $students = \App\Models\StudentDetail::with('user')
        ->whereNotNull('face_descriptor')
        ->get();

        return view('teacher.attendance.face-scan', compact('students'));
    }

    // AttendanceController.php

    public function studentFaceList()
    {
        $students = \App\Models\StudentDetail::with('user')
            ->latest()
            ->paginate(10);

        return view('teacher.attendance.student-face-list', compact('students'));
    }

    // school's dashboard
    public function schoolFaceRegisterForm($id)
    {
        $student = \App\Models\StudentDetail::with('user')->findOrFail($id);

        return view('school.attendance.face-register', compact('student'));
    }

    public function schoolSaveFace(Request $request, $id)
    {
        $student = \App\Models\StudentDetail::findOrFail($id);

        $request->validate([
            'image' => 'required',
            'descriptor' => 'required'
        ]);

        // Save image
        $image = $request->image;

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = 'faces/' . time() . '_' . $id . '.png';

        \Storage::disk('public')->put($imageName, base64_decode($image));

        // Save DB
        $student->update([
            'face_photo' => $imageName,
            'face_descriptor' => $request->descriptor
        ]);

        return redirect()->back()->with('success', 'Face registered successfully');
    }

    // public function schoolFaceScan()
    // {
    //     $students = \App\Models\StudentDetail::with('user')
    //     ->whereNotNull('face_descriptor')
    //     ->get();

    //     return view('school.attendance.face-scan', compact('students'));
    // }

    public function schoolStudentFaceList()
    {
        $students = \App\Models\StudentDetail::with('user')
            ->latest()
            ->paginate(10);

        return view('school.attendance.student-face-list', compact('students'));
    }
}