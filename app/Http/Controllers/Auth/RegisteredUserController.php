<?php
// app/Http/Controllers/Auth/RegisteredUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentDetail; // Add this
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\TeacherDetail;
use App\Models\SchoolDetail;
use App\Models\School;
use App\Models\ClassLevel;
use Illuminate\Support\Str; // Add this for generating registration number

class RegisteredUserController extends Controller
{
    /**
     * Display available school.
     */
    public function create(): View
    {
        $schools = School::all();
        return view('auth.register', compact('schools'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'user_type' => ['required', 'in:student,teacher,school'],
            'exam_type' => ['required', 'string'],
            'school_id' => ['nullable', 'exists:schools,id'],
            'class_level' => ['nullable', 'exists:classes,id'],
            'teacher_school' => ['nullable', 'exists:schools,id']
        ]);

        // Set exam type based on user type
        if($request->user_type === 'teacher' || $request->user_type === 'school'){
            $examType = 'GENERAL';
        } else {
            $examType = $request->exam_type;
        }

        // Create User FIRST
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'exam_type' => $examType,
            'role' => $request->user_type,
            'is_active' => false
        ]);

        \Log::info('User created', ['user_id' => $user->id, 'role' => $user->role]);

        /*
        |--------------------------------------------------------------------------
        | SCHOOL REGISTRATION
        |--------------------------------------------------------------------------
        */
        if($request->user_type === 'school'){
            // First, create the school record
            $school = School::create([
                'name' => $request->school_name,
                'address' => $request->address,
                'registration_number' => 'SCH' . strtoupper(Str::random(8)),
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            
            \Log::info('School created', ['school_id' => $school->id]);

            // Then create school_details linking user to school
            SchoolDetail::create([
                'user_id' => $user->id,
                'school_id' => $school->id,
                'has_paid' => true
            ]);
            
            \Log::info('SchoolDetail created', ['user_id' => $user->id, 'school_id' => $school->id]);
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHER REGISTRATION
        |--------------------------------------------------------------------------
        */
        if($request->user_type === 'teacher'){
            TeacherDetail::create([
                'user_id' => $user->id,
                'school_id' => $request->teacher_school,
                'has_paid' => true
            ]);
            
            \Log::info('TeacherDetail created', ['user_id' => $user->id, 'school_id' => $request->teacher_school]);
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT REGISTRATION
        |--------------------------------------------------------------------------
        */
        if($request->user_type === 'student'){
            StudentDetail::create([
                'user_id' => $user->id,
                'registration_number' => 'STU' . strtoupper(Str::random(8)),
                'school_id' => $request->school_id,
                'class_id' => $request->class_level,
                'has_paid' => false
            ]);
            
            \Log::info('StudentDetail created', [
                'user_id' => $user->id, 
                'school_id' => $request->school_id,
                'class_id' => $request->class_level
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on user type
        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard')
                ->with('success', 'Welcome teacher! Your account has been created.');
        }

        if ($user->role === 'school') {
            return redirect()->route('school.dashboard')
                ->with('success', 'Welcome! Your school account has been created.');
        }
        
        if ($user->role === 'student') {
            return redirect()->route('payment.show')
                ->with('success', 'Registration successful! Please complete payment to activate your account.');
        }

        // Fallback redirect
        return redirect()->route('dashboard');
    }
}