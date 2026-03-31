<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExamAttempt;

class DashboardController extends Controller
{

    public function index()
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
}