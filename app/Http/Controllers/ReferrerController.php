<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Models\Commission;
use App\Models\School;
use App\Models\User;
use App\Models\Withdrawal;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReferrerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $referrer_code = $user->referral_code;

        if (!$user) {
            return redirect()->route('login');
        }

        $wallet = DB::table('wallets')
            ->where('user_id', $user->id)
            ->value('balance') ?? 0;

        $commissions = Commission::where('referrer_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        $totalEarnings = Commission::where('referrer_id', $user->id)
            ->sum('amount');

        $studentRefs = StudentDetail::where('referral_user_id', $user->id)
            ->count();

        $schoolRefs = School::where('referral_user_id', $user->id)
            ->count();

        $totalRefs = $studentRefs + $schoolRefs;

        return view('referrer.dashboard', compact(
            'wallet',
            'commissions',
            'totalEarnings',
            'studentRefs',
            'schoolRefs',
            'totalRefs',
            'referrer_code'
        ));
    }

    public function withdrawForm()
    {
        return view('referrer.withdraw');
    }

    public function submitWithdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required'
        ]);

        $user = auth()->user();

        $wallet = DB::table('wallets')
            ->where('user_id', $user->id)
            ->value('balance') ?? 0;

        if ($request->amount > $wallet) {
            return back()->with('error', 'Insufficient wallet balance');
        }

        \App\Models\Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'status' => 'pending'
        ]);

        DB::table('wallets')
            ->where('user_id', $user->id)
            ->decrement('balance', $request->amount);

        return back()->with('success', 'Withdrawal request submitted');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('referrer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        \Log::info('Profile update request received', [
            'has_file' => $request->hasFile('profile_photo'),
            'has_captured_photo' => !empty($request->captured_photo),
            'all_files' => $request->allFiles(),
        ]);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // ✅ MUST COME FIRST
        $user = auth()->user();

        // ✅ Update basic info
        $user->name  = $request->name;
        $user->email = $request->email;

        // ✅ Ensure directory exists
        if (!file_exists(public_path('storage/profile'))) {
            mkdir(public_path('storage/profile'), 0777, true);
        }

        // =========================================
        // ✅ HANDLE CAMERA CAPTURE (BASE64)
        // =========================================

        if (!empty($request->captured_photo)) {

            \Log::info('Captured photo detected');

            // Delete old photo
            if (
                $user->profile_photo &&
                file_exists(public_path('storage/profile/' . $user->profile_photo))
            ) {
                unlink(public_path('storage/profile/' . $user->profile_photo));
            }

            // Extract image
            $image = $request->captured_photo;

            $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);

            $image = str_replace(' ', '+', $image);

            $imageData = base64_decode($image);

            // Generate filename
            $filename = Str::uuid() . '.jpg';

            // Save image
            file_put_contents(
                public_path('storage/profile/' . $filename),
                $imageData
            );

            // Save filename to DB
            $user->profile_photo = $filename;

            \Log::info('Captured photo saved', [
                'filename' => $filename
            ]);
        }

        // =========================================
        // ✅ HANDLE NORMAL FILE UPLOAD
        // =========================================

        elseif ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');

            // Delete old photo
            if (
                $user->profile_photo &&
                file_exists(public_path('storage/profile/' . $user->profile_photo))
            ) {
                unlink(public_path('storage/profile/' . $user->profile_photo));
            }

            $filename = Str::uuid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('storage/profile'),
                $filename
            );

            $user->profile_photo = $filename;

            \Log::info('Uploaded photo saved', [
                'filename' => $filename
            ]);
        }

        // ✅ SAVE USER
        $user->save();

        // ✅ Activity log
        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Updated profile',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'success',
            'Profile updated successfully'
        );
    }

    public function password()
    {
        return view('referrer.password');
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

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => $user->id,
            'activity' => 'Changed password',
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
            ->paginate(10);

        return view('referrer.activity', compact('logs'));
    }

    public function withdrawHistory()
    {
        $withdrawals = \App\Models\Withdrawal::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('referrer.withdraw-history', compact('withdrawals'));
    }

    public function analytics()
    {
        $userId = auth()->id();

        $wallet = DB::table('wallets')
            ->where('user_id', $userId)
            ->value('balance') ?? 0;

        $totalEarnings = \App\Models\Commission::where('referrer_id', $userId)
            ->sum('amount');

        $studentRefs = \App\Models\StudentDetail::where('referral_user_id', $userId)
            ->count();

        $schoolRefs = \App\Models\School::where('referral_user_id', $userId)
            ->count();

        $monthly = \App\Models\Commission::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->where('referrer_id', $userId)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('referrer.analytics', compact(
            'wallet',
            'totalEarnings',
            'studentRefs',
            'schoolRefs',
            'monthly'
        ));
    }

    public function settings()
    {
        $user = auth()->user();

        return view('referrer.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'email_alerts'   => $request->has('email_alerts') ? 1 : 0,
            'bank_name'      => $request->bank_name,
            'account_name'   => $request->account_name,
            'account_number' => $request->account_number
        ]);

        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Updated settings',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Settings updated successfully');
    }
}