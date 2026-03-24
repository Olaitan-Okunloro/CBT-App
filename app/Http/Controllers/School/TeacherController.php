<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;

class TeacherController extends Controller
{

    // TeacherController  
    public function dashboard()
    {
        return view('dashboard.teacher', ['user' => auth()->user()]);
    }

    /**
     * Display available school.
     */

    public function create()
    {
        $classes = ClassLevel::all();
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
