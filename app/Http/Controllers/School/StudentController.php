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

class StudentController extends Controller
{

    // StudentController
    public function dashboard()
    {
        return view('dashboard.student', ['user' => auth()->user()]);
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
}
