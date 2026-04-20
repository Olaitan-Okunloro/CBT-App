<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use App\Models\ExamAttempt;
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
            case 'referrer':
                return redirect()->route('referrer.dashboard');  
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

    public function analytics()
    {
        $totalStudents = User::where('role','student')->count();
        $totalAttempts = ExamAttempt::count();
        $averageScore = ExamAttempt::avg('score');

        return view('dashboard.leaderboard', compact(
            'totalStudents',
            'totalAttempts',
            'averageScore'
        ));
    }

    public function withdrawals()
    {
        $rows = Withdrawal::latest()->paginate(15);

        $pending = Withdrawal::where('status', 'pending')->count();
        $approved = Withdrawal::where('status', 'approved')->count();
        $paid = Withdrawal::where('status', 'paid')->count();

        $requestedAmount = Withdrawal::sum('amount');
        $paidAmount = Withdrawal::where('status', 'paid')->sum('amount');

        return view('admin.withdrawals', compact(
            'rows',
            'pending',
            'approved',
            'paid',
            'requestedAmount',
            'paidAmount'
        ));
    }

    public function approveWithdrawal($id)
    {
        $row = Withdrawal::findOrFail($id);

        $row->update([
            'status' => 'approved'
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => $row->user_id,
            'activity' => 'Withdrawal approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Withdrawal approved');
    }

    public function rejectWithdrawal($id)
    {
        $row = Withdrawal::findOrFail($id);

        $row->update([
            'status' => 'rejected'
        ]);

        DB::table('wallets')
            ->where('user_id', $row->user_id)
            ->increment('balance', $row->amount);

        DB::table('activity_logs')->insert([
            'user_id' => $row->user_id,
            'activity' => 'Withdrawal rejected and funds returned',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Withdrawal rejected');
    }

    public function paidWithdrawal($id)
    {
        $row = Withdrawal::findOrFail($id);

        $row->update([
            'status' => 'paid'
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => $row->user_id,
            'activity' => 'Withdrawal paid successfully',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Marked as paid');
    }
}