<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use App\Models\Question;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use App\Models\ExamAttempt;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

    public function admin()
    {
        $schools = \App\Models\School::count();

        $teachers = \App\Models\User::where('role', 'teacher')->count();

        $students = \App\Models\User::where('role', 'student')->count();

        $referrers = \App\Models\User::where('role', 'referrer')->count();

        $totalUsers = \App\Models\User::count();

        $questions = DB::table('question_banks')->count();

        $results = DB::table('result_scores')->count();

        $revenue_from_payment = DB::table('payments')
            ->where('status', 'success')
            ->sum('amount');

        $revenue_from_bulk_payment = DB::table('bulk_payments')
            ->where('status', 'success')
            ->sum('amount');
        
        $revenue = $revenue_from_payment + $revenue_from_bulk_payment;  

        $withdrawals = DB::table('withdrawals')
            ->where('status', 'paid')
            ->sum('amount');

        $pendingWithdrawals = DB::table('withdrawals')
            ->where('status', 'pending')
            ->count();

        return view('dashboard.admin', compact(
            'schools',
            'teachers',
            'students',
            'referrers',
            'totalUsers',
            'questions',
            'results',
            'revenue',
            'withdrawals',
            'pendingWithdrawals'
        ));
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

    // public function analytics()
    // {
    //     $totalStudents = User::where('role','student')->count();
    //     $totalAttempts = ExamAttempt::count();
    //     $averageScore = ExamAttempt::avg('score');

    //     return view('dashboard.leaderboard', compact(
    //         'totalStudents',
    //         'totalAttempts',
    //         'averageScore'
    //     ));
    // }

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

    public function withdrawHistory()
    {
        $rows = \App\Models\Withdrawal::latest()->paginate(10);

        return view('admin.withdraw-history', compact('rows'));
    }

    public function analytics()
    {
        $monthlyRevenuePayments = DB::table('payments')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as ym,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('status', 'success')
            ->groupBy('ym', 'month')
            ->orderBy('ym')
            ->get();

        $monthlyRevenueBulk = DB::table('bulk_payments')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as ym,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('status', 'success')
            ->groupBy('ym', 'month')
            ->orderBy('ym')
            ->get();

        $monthlyPayout = DB::table('withdrawals')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as ym,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('status', 'paid')
            ->groupBy('ym', 'month')
            ->orderBy('ym')
            ->get();

        return view('admin.analytics', compact(
            'monthlyRevenuePayments',
            'monthlyRevenueBulk',
            'monthlyPayout'
        ));
    }

    public function users()
    {
        $rows = \App\Models\User::latest()->paginate(10);

        return view('admin.users', compact('rows'));
    }

    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot delete your own account');
        }

        if ($user->role == 'admin') {
            return back()->with('error', 'Admin account cannot be deleted');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }

    public function toggleUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if ($user->role == 'admin') {
            return back()->with('error','Admin cannot be suspended');
        }

        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot suspend yourself');
        }

        $user->status = $user->status == 'active'
            ? 'suspended'
            : 'active';

        $user->save();

        return back()->with('success', 'User status updated');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('admin.profile', compact('user'));
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
            'activity'   => 'Updated admin profile',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Profile updated successfully');
    }

    public function password()
    {
        return view('admin.password');
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

        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Changed admin password',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Password changed successfully');
    }

    public function activity()
    {
        $logs = DB::table('activity_logs')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('admin.activity', compact('logs'));
    }

    public function settings()
    {
        $sub = \App\Models\Subscription::first();

        return view('admin.settings', compact('sub'));
    }

    public function updateSettings(Request $request)
    {
        $sub = \App\Models\Subscription::first();

        $sub->update([
            'sub_amount' => $request->sub_amount,
            'email_sub'  => $request->email_sub
        ]);

        DB::table('activity_logs')->insert([
            'user_id'    => auth()->id(),
            'activity'   => 'Updated system settings',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Settings updated successfully');
    }

    public function announcements()
    {
        $rows = DB::table('announcements')
            ->latest()
            ->paginate(10);

        return view('admin.announcements', compact('rows'));
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);

        DB::table('announcements')->insert([
            'title' => $request->title,
            'message' => $request->message,
            'audience' => $request->audience,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Posted announcement',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Announcement posted');
    }

    public function support()
    {
        $rows = DB::table('support_tickets')
            ->latest()
            ->paginate(10);

        return view('admin.support', compact('rows'));
    }

    public function resolveSupport($id)
    {
        DB::table('support_tickets')
            ->where('id', $id)
            ->update([
                'status' => 'resolved',
                'updated_at' => now()
            ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Resolved support ticket',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Ticket marked as resolved');
    }

    public function deleteSupport($id)
    {
        DB::table('support_tickets')
            ->where('id', $id)
            ->delete();

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Deleted support ticket',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Ticket deleted');
    }
}