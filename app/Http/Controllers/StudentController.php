<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\StudentDetail;

class StudentController extends Controller
{
    
    /**
     * Show available exams for students
     */
    public function availableExams()
    {
        // Get available exams (you can modify this query based on your logic)
        $exams = Exam::where('is_published', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now())
                     ->get();
        
        return view('student.available-exams', compact('exams'));
    }

    /**
     * Show student results
     */
    public function results()
    {
        $user = auth()->user();
        
        // Get student's exam attempts with results
        $results = $user->examAttempts()
                        ->with('exam')
                        ->where('status', 'completed')
                        ->get();
        
        return view('student.results', compact('results'));
    }

    /**
     * Take an exam
     */
    public function takeExam($examId)
    {
        $exam = Exam::with('questions')->findOrFail($examId);
        
        // Check if student has already taken this exam
        $attempt = auth()->user()->examAttempts()
                        ->where('exam_id', $examId)
                        ->where('status', 'completed')
                        ->first();
        
        if ($attempt) {
            return redirect()->route('student.results')
                           ->with('error', 'You have already taken this exam.');
        }
        
        return view('student.take-exam', compact('exam'));
    }

}