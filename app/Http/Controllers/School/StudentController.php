<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentDetail;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use App\Mail\UserCreatedMail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Exports\StudentsExport;
use App\Models\ExamAttempt;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function dashboard()
    {
        
        $user = auth()->user();

        $attempts = ExamAttempt::where('user_id', $user->id)->get();

        $subjectStats = ExamAttempt::with('exam.subject')
            ->where('user_id', $user->id)
            ->get()
            ->groupBy('exam.subject.name');

        $totalExams = $attempts->count();
        $averageScore = $attempts->avg('score');
        $highestScore = $attempts->max('score');

        return view('dashboard.student', ['user' => auth()->user()], compact(
            'totalExams',
            'averageScore',
            'highestScore',
            'attempts',
            'subjectStats'
        ));
    }
    
    // Show form
    public function create()
    {
        $classes = ClassLevel::all();

        return view('school.student.create', compact('classes'));
    }

    // Save student
    public function store(Request $request)
    {
        $request->validate([
            'students' => 'required|array|min:1',
            'students.*.name' => 'required|string|max:255',
            'students.*.email' => 'required|email|unique:users,email',
            'students.*.parent_email' => 'required|email',
            'students.*.phone' => 'required|string|max:20',
            'students.*.class_id' => 'required|exists:classes,id',
        ]);

        // Get logged-in school details
        $schoolDetail = auth()->user()->schoolDetail;
        $school = $schoolDetail->school;
        $schoolId = $school->id;
        
        $password = 'password123'; // Default password
        $successCount = 0;
        $errors = [];

        foreach ($request->students as $index => $studentData) {
            try {
                // Check if email already exists
                $existingUser = User::where('email', $studentData['email'])->exists();
                if ($existingUser) {
                    $errors[] = "Student " . ($index + 1) . " ({$studentData['email']}) already exists.";
                    continue;
                }

                // Create user account
                $user = User::create([
                    'name' => $studentData['name'],
                    'email' => $studentData['email'],
                    'password' => Hash::make($password),
                    'phone' => $studentData['phone'],
                    'role' => 'student',
                    'exam_type' => 'GENERAL',
                    'is_active' => true
                ]);

                // Send Email (optional - can be disabled for bulk upload)
                try {
                    Mail::to($user->email)->send(new UserCreatedMail($user, $password));
                } catch (\Exception $e) {
                    \Log::error('Failed to send email to: ' . $user->email);
                }

                // Find teacher for this class
                $teacher = \App\Models\TeacherDetail::where('class_id', $studentData['class_id'])
                    ->where('school_id', $schoolId)
                    ->first();

                $hasPaid = $school->payment_plan === 'paid' ? true : false;
                $schoolReferrer = \App\Models\School::where('id', $schoolId)->first();

                // Create student details
                StudentDetail::create([
                    'user_id' => $user->id,
                    'registration_number' => 'STU' . strtoupper(Str::random(8)),
                    'school_id' => $schoolId,
                    'class_id' => $studentData['class_id'],
                    'teacher_id' => $teacher ? $teacher->user_id : null,
                    'has_paid' => $hasPaid,
                    'guardian_email' => $studentData['parent_email'],
                    'referrer_code_used' => $schoolReferrer->referrer_code_used ?? null,
                    'referral_user_id' => $schoolReferrer->referral_user_id ?? null
                ]);

                $successCount++;

            } catch (\Exception $e) {
                $errors[] = "Student " . ($index + 1) . " ({$studentData['name']}) failed: " . $e->getMessage();
            }
        }

        $message = "$successCount student(s) created successfully!";
        
        if (!empty($errors)) {
            $message .= " Errors: " . implode('; ', $errors);
            return redirect()->back()->with('warning', $message);
        }

        return redirect()->route('school.students')->with('success', $message);
    }

    // import bulk records
    public function importForm()
    {
        return view('school.student.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        $schoolId = auth()->user()->schoolDetail->school_id;

        Excel::import(
            new StudentsImport($schoolId, $request->class_id),
            $request->file('file')
        );
        session(['created_students' => session('created_students', [])]);
        return redirect()->route('school.students.download.page');
    }

    public function downloadPage()
    {
        $students = session('created_students', []);

        return view('school.student.download', compact('students'));
    }

    // export credential
    public function downloadCredentials()
    {
        $data = session('created_students', []);

        if (empty($data)) {
            return back()->with('error','No data available');
        }

        return Excel::download(new StudentsExport($data), 'students_credentials.xlsx');
    }

    // available exams route
    public function availableExams()
    {
        // Get available exams (you can modify this query based on your logic)
        // $exams = Exam::where('is_published', true)
        //              ->where('start_date', '<=', now())
        //              ->where('end_date', '>=', now())
        //              ->get();

        return view('student.available-exams');
    }

     /**
     * Display results for a student
     */
    public function results(Request $request, $id = null)
    {
        // If ID is passed directly
        if ($id) {
            $student = Student::with('user')->findOrFail($id);
        } 
        // Or get from authenticated user
        else {
            $student = Student::where('user_id', auth()->id())->firstOrFail();
        }

        // Get results for this student
        $results = Result::with('subject')
            ->where('student_id', $student->id)
            ->get();

        return view('student.results.student-result', compact('student', 'results'));
    }

    // public function profile()
    // {
    //     $student = \App\Models\StudentDetail::with('user')
    //         ->where('user_id', auth()->id())
    //         ->first();

    //     return view('student.profile', compact('student'));
    // }

    public function profile()
    {
        $user = auth()->user();

        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $user = auth()->user();

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('storage/profile'), $filename);

            $user->profile_photo = $filename;
        }

        $user->save();

        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Updated profile',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Profile updated successfully');
    }

    public function changePassword()
    {
        return view('student.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Changed Password'
        ]);

        return back()->with('success', 'Password changed successfully');
    }

    public function activityLog()
    {
        $logs = \App\Models\ActivityLog::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('student.activity-log', compact('logs'));
    }

    public function practicePage()
    {
        $subjects = \App\Models\Subject::all();
        $topics   = \App\Models\Topic::all();

        return view(
            'student.practice.index',
            compact('subjects', 'topics')
        );
    }

    public function startPractice(Request $request)
    {
        $studentId = auth()->id();

        $query = \App\Models\Question::where(
            'topic_id',
            $request->topic_id
        );

        if ($request->mode == '20') {

            $query->inRandomOrder()
                ->limit(20);

        } elseif ($request->mode == '50') {

            $query->inRandomOrder()
                ->limit(50);

        } elseif ($request->mode == 'remaining') {

            $attempted = DB::table(
                'student_question_attempts'
            )
            ->where('student_id', $studentId)
            ->pluck('question_id');

            $query->whereNotIn('id', $attempted);

        } elseif ($request->mode == 'wrong') {

            $wrong = DB::table(
                'student_question_attempts'
            )
            ->where('student_id', $studentId)
            ->where('is_correct', 0)
            ->pluck('question_id');

            $query->whereIn('id', $wrong);

        }

        $rows = $query->get();

        session([
            'practice_questions' => $rows
        ]);

        return redirect()->route(
            'student.practice.exam'
        );
    }

    public function practiceDashboard()
    {
        $studentId = auth()->id();

        $totalAttempted = DB::table(
            'student_question_attempts'
        )
        ->where('student_id', $studentId)
        ->count();

        $correct = DB::table(
            'student_question_attempts'
        )
        ->where('student_id', $studentId)
        ->where('is_correct', 1)
        ->count();

        $wrong = $totalAttempted - $correct;

        $topics = DB::table(
            'student_question_attempts as s'
        )
        ->join('topics as t', 't.id', '=', 's.topic_id')
        ->select(
            't.topic',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(is_correct) as correct')
        )
        ->where('student_id', $studentId)
        ->groupBy('t.topic')
        ->get();

        $chart = DB::table(
            'student_question_attempts'
        )
        ->selectRaw(
            'DATE(attempted_at) as day,
            COUNT(*) as total'
        )
        ->where('student_id', $studentId)
        ->groupBy('day')
        ->orderBy('day')
        ->get();

        $streak = DB::table(
            'student_question_attempts'
        )
        ->selectRaw(
            'DATE(attempted_at) as day'
        )
        ->where('student_id', $studentId)
        ->groupBy('day')
        ->orderByDesc('day')
        ->pluck('day')
        ->toArray();

        $dailyStreak = 0;
        $date = now()->toDateString();

        foreach ($streak as $day) {

            if ($day == $date) {

                $dailyStreak++;
                $date = date(
                    'Y-m-d',
                    strtotime($date . ' -1 day')
                );

            } else {
                break;
            }
        }

        return view(
            'student.practice.dashboard',
            compact(
                'totalAttempted',
                'correct',
                'wrong',
                'topics',
                'chart',
                'dailyStreak'
            )
        );
    }

    public function showClassForm()
    {
        $classes = \App\Models\ClassLevel::all();

        return view('student.external.select-class', compact('classes'));
    }

    public function saveClass(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id'
        ]);

        $user = auth()->user();


        // option 2 (if you prefer student_details)
        if ($user->studentDetail) {
            $user->studentDetail->class_id = $request->class_id;
            $user->studentDetail->save();
        }

        return redirect()->route('dashboard')
            ->with('success', 'Class selected successfully.');
    }

}
