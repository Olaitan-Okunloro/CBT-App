<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Exports\StudentsExport;
use App\Models\ExamAttempt;

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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'class_id' => 'required',
            'phone' => 'required',
        ]);

        // Get logged-in school ID
        $schoolId = auth()->user()->schoolDetail->school_id;

        // Create user account
        $password = Str::random(8);
        // $password = 'password123';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'phone' => $request->phone,
            'role' => 'student',
            'exam_type' => 'GENERAL',
            'is_active' => false
        ]);

        // Send Email
        Mail::to($user->email)->send(new UserCreatedMail($user, $password));

        $school = auth()->user()->schoolDetail->school;

        $teacher = \App\Models\TeacherDetail::where('class_id', $request->class_id)
        ->where('school_id', $schoolId)
        ->first();

        $hasPaid = $school->payment_plan === 'paid' ? true : false;

        StudentDetail::create([
            'user_id' => $user->id,
            'registration_number' => 'STU'.strtoupper(Str::random(8)),
            'school_id' => $school->id,
            'class_id' => $request->class_id,
            'teacher_id' => $teacher ? $teacher->user_id : null,
            'has_paid' => $hasPaid
        ]);

        return back()->with('success','Student created successfully');
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

    public function profile()
    {
        $student = \App\Models\StudentDetail::with('user')
            ->where('user_id', auth()->id())
            ->first();

        return view('student.profile', compact('student'));
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

}
