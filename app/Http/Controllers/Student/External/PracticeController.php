<?php
// app/Http/Controllers/Student/External/PracticeController.php

namespace App\Http\Controllers\Student\External;

use App\Http\Controllers\Controller;
use App\Models\QuestionBank;
use App\Models\StudentQuestionAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticeController extends Controller
{
    /**
     * Show the practice selection page
     */
    public function dashboard()
    {
        $subjects = \App\Models\Subject::all();
        $classes = \App\Models\ClassLevel::all();
        
        return view('student.external.practice', compact('subjects', 'classes'));
    }
    
    /**
     * Start practice - fetch questions directly
     */
    public function startPractice(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'class_id' => 'required|exists:class_levels,id',
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
        ]);
        
        $classId = $request->class_id;
        $subjectId = $request->subject_id;
        $topicId = $request->topic_id;
        
        // Get previously answered correct question IDs
        $correctQuestionIds = StudentQuestionAttempt::where('student_id', $user->id)
            ->where('topic_id', $topicId)
            ->where('is_correct', 1)
            ->pluck('question_id')
            ->toArray();
        
        // Fetch questions directly from question_banks
        $questions = QuestionBank::where('class_level_id', $classId)
            ->where('subject_id', $subjectId)
            ->where('topic_id', $topicId)
            ->when(!empty($correctQuestionIds), function($query) use ($correctQuestionIds) {
                return $query->whereNotIn('id', $correctQuestionIds);
            })
            ->inRandomOrder()
            ->take(20)
            ->get();
        
        // If all questions were answered correctly, reset and get all questions
        if ($questions->isEmpty()) {
            // Reset attempts for this topic
            StudentQuestionAttempt::where('student_id', $user->id)
                ->where('topic_id', $topicId)
                ->delete();
            
            // Fetch all questions again
            $questions = QuestionBank::where('class_level_id', $classId)
                ->where('subject_id', $subjectId)
                ->where('topic_id', $topicId)
                ->inRandomOrder()
                ->take(20)
                ->get();
        }
        
        if ($questions->isEmpty()) {
            return back()->with('error', 'No questions available for this topic yet.');
        }
        
        // Store in session for tracking
        session([
            'practice_questions' => $questions,
            'practice_total' => $questions->count(),
            'practice_current_index' => 0,
            'practice_class_id' => $classId,
            'practice_subject_id' => $subjectId,
            'practice_topic_id' => $topicId
        ]);
        
        return redirect()->route('student.external.practice.show');
    }
    
    /**
     * Show current question
     */
    public function showQuestion()
    {
        $questions = session('practice_questions');
        $currentIndex = session('practice_current_index', 0);
        $total = session('practice_total', 0);
        
        if (!$questions || $currentIndex >= $total) {
            return redirect()->route('student.practice.dashboard')
                ->with('success', 'Practice completed! You have answered all questions.');
        }
        
        $question = $questions[$currentIndex];
        
        return view('student.external.practice-question', compact('question', 'currentIndex', 'total'));
    }
    
    /**
     * Submit answer
     */
    public function submitAnswer(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'question_id' => 'required',
            'answer' => 'required',
            'topic_id' => 'required'
        ]);
        
        $question = QuestionBank::find($request->question_id);
        $isCorrect = ($question->correct_answer === $request->answer);
        
        // Record the attempt
        StudentQuestionAttempt::create([
            'student_id' => $user->id,
            'question_id' => $request->question_id,
            'topic_id' => $request->topic_id,
            'selected_answer' => $request->answer,
            'is_correct' => $isCorrect,
            'created_at' => now()
        ]);
        
        // Update session index
        $currentIndex = session('practice_current_index', 0);
        session(['practice_current_index' => $currentIndex + 1]);
        
        return response()->json([
            'success' => true,
            'is_correct' => $isCorrect,
            'correct_answer' => $question->correct_answer
        ]);
    }
}