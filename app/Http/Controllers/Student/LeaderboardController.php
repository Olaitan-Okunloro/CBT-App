<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAttempt;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaders = ExamAttempt::with('user', 'exam.subject')
            ->where('status', 'completed')
            ->orderByDesc('score')
            ->take(10)
            ->get();

        return view('student.leaderboard', compact('leaders'));
    }
}