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
use Illuminate\Support\Facades\DB;

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
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users'],
            'phone'     => ['required'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:student,school,referrer'],
        ]);

        $role = $request->user_type;

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'exam_type' => 'EXTERNAL',
            'password'  => Hash::make($request->password),
            'role'      => $role,
            'is_active' => false,
            'is_referrer' => $role == 'referrer' ? 1 : 0,
            'referral_code' => $role == 'referrer'
                ? rand(100000, 999999)
                : null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | REFERRER
        |--------------------------------------------------------------------------
        */
        if ($role == 'referrer') {
            event(new Registered($user));
            Auth::login($user);

            DB::table('wallets')->insert([
                'user_id' => $user->id,
                'balance' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('referrer.dashboard')
                ->with('success', 'Referrer account created successfully.');
        }

        /*
        |--------------------------------------------------------------------------
        | SCHOOL
        |--------------------------------------------------------------------------
        */
        if ($role == 'school') {

            $usedCode = $request->school_referral_code;

            $referrerId = null;

            if ($usedCode && $usedCode != '246800') {
                $referrer = User::where('referral_code', $usedCode)->first();
                $referrerId = $referrer->id ?? null;
            }

            $school = School::create([
                'name' => $request->school_name,
                'address' => $request->address,
                'registration_number' => 'SCH' . strtoupper(Str::random(8)),
                'email' => $request->email,
                'phone' => $request->phone,
                'referrer_code_used' => $usedCode,
                'referral_user_id' => $referrerId,
            ]);

            SchoolDetail::create([
                'user_id' => $user->id,
                'school_id' => $school->id,
                'has_paid' => true
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */
        if ($role == 'student') {

            $usedCode = $request->student_referral_code;

            $referrerId = null;

            if ($usedCode && $usedCode != '246800') {
                $referrer = User::where('referral_code', $usedCode)->first();
                $referrerId = $referrer->id ?? null;
            }

            StudentDetail::create([
                'user_id' => $user->id,
                'registration_number' => 'STU' . strtoupper(Str::random(8)),
                'school_id' => $request->school_id,
                'class_id' => $request->class_level,
                'has_paid' => false,
                'referrer_code_used' => $usedCode,
                'referral_user_id' => $referrerId
            ]);
        }

        event(new Registered($user));
        Auth::login($user);

        if ($role == 'school') {
            return redirect()->route('school.dashboard');
        }

        return redirect()->route('payment.show');
    }
}