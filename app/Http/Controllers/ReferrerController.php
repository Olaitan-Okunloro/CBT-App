<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Models\Commission;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReferrerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

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

        $studentRefs = StudentDetail::where('referrer_user_id', $user->id)
            ->count();

        $schoolRefs = School::where('referrer_user_id', $user->id)
            ->count();

        $totalRefs = $studentRefs + $schoolRefs;

        return view('referrer.dashboard', compact(
            'wallet',
            'commissions',
            'totalEarnings',
            'studentRefs',
            'schoolRefs',
            'totalRefs'
        ));
    }
}