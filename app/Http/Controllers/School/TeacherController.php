<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassLevel;
use App\Models\SchoolClass;
use App\Models\TeacherDetail;
use App\Mail\UserCreatedMail;
use App\Models\StudentDetail;
use App\Models\ExamAttempt;
use App\Models\Question;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class TeacherController extends Controller
{

    // TeacherController  
    // public function dashboard()
    // {
    //     return view('dashboard.teacher', ['user' => auth()->user()]);
    // }

    public function dashboard()
    {
        $teacher = auth()->user();
        
        // Get students in teacher's class
        $students = StudentDetail::where('class_id', $teacher->teacherDetail->class_id)
            ->pluck('user_id');
        
        // Get all attempts from these students with relationships
        $attempts = ExamAttempt::whereIn('user_id', $students)
            ->with(['user', 'exam'])
            ->latest()
            ->get();
        
        // Get recent attempts (last 10)
        $recentAttempts = $attempts->take(10);
        
        // Get teacher's questions count
        $questionsCount = Question::where('created_by', $teacher->id)->count();
        
        return view('dashboard.teacher', [
            'studentsCount' => $students->count(),
            'avgScore' => $attempts->avg('score'),
            'totalAttempts' => $attempts->count(),
            'questionsCount' => $questionsCount,
            'recentAttempts' => $recentAttempts
        ]);
    }

    /**
     * Display available school.
     */

    public function create()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school ?? null;

        if (!$school) {
            return redirect()->back()->with('error', 'School not found.');
        }

        $classes = SchoolClass::with('classLevel')
            ->where('school_id', $school->id)
            ->get()
            ->map(fn($row) => (object)[
                'id' => $row->class_level_id,
                'name' => $row->classLevel->name
            ]);

        return view('school.teacher.create', compact('classes'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'class_id' => 'required',
        ]);

        // Get school id of logged in school
        $schoolId = auth()->user()->schoolDetail->school_id;

        // Create teacher user
        // $password = Str::random(8);
        $password = 'password123';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'phone' => $request->phone,
            'role' => 'teacher',
            'exam_type' => 'GENERAL',
            'is_active' => true
        ]);

        // Send Email
        Mail::to($user->email)->send(new UserCreatedMail($user, $password));

        // Link teacher to school
        TeacherDetail::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'school_id' => $schoolId,
            'has_paid' => true
        ]);

        return redirect()->back()->with('success','Teacher created successfully');
    }

}
