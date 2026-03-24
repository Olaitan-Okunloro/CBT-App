<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Redirect based on role
        switch($user->role) {
            case 'student':
                return redirect()->route('student.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'school':
                return redirect()->route('school.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('login');
        }
    }

    public function teacher()
    {

        $teacher = auth()->user();

        $students = StudentDetail::where('school_id',$teacher->teacherDetail->school_id)->count();

        $questions = Question::where('created_by',$teacher->id)->count();

        return view('dashboard.teacher',[
        'students'=>$students,
        'questions'=>$questions
        ]);

    }


    public function school()
    {

        $school = auth()->user()->schoolDetail->school_id;

        $teachers = TeacherDetail::where('school_id',$school)->count();

        $students = StudentDetail::where('school_id',$school)->count();

        return view('dashboard.school',[
        'teachers'=>$teachers,
        'students'=>$students
        ]);

    }

    public function admin()
    {

        $schools = \App\Models\School::count();

        $teachers = User::where('role','teacher')->count();

        $students = User::where('role','student')->count();

        return view('dashboard.admin',[
        'schools'=>$schools,
        'teachers'=>$teachers,
        'students'=>$students
        ]);

    }
}