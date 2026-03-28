<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamAttempt;
use App\Models\Answer;

class ExamController extends Controller
{
    public function start(Request $request, $examId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $exam = Exam::findOrFail($examId);

        $query = Question::where('subject_id', $exam->subject_id);

        if ($user->role === 'student') {

            if ($user->studentDetail?->school_id) {

                $query->where('source', 'internal')
                    ->where('school_id', $user->studentDetail->school_id)
                    ->where('class_level_id', $user->studentDetail->class_id);

            } else {

                $query->where('source', 'external');
            }
        }

        // Split questions into types
        $total = $exam->total_questions;
        $half = ceil($total / 2);

        $objective = (clone $query)
            ->where('question_type', 'objective')
            ->inRandomOrder()
            ->take($half)
            ->get();

        $fill = (clone $query)
            ->where('question_type', 'fill_in_the_gap')
            ->inRandomOrder()
            ->take($half)
            ->get();

        $questions = $objective->merge($fill)->shuffle();

        // Merge both
        $questions = $objective->merge($fill)->shuffle();

        if ($questions->isEmpty()) {
            return back()->with('error', 'No questions available for this exam.');
        }

        // Create attempt
        $attempt = ExamAttempt::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'total' => $questions->count(),
            'started_at' => now()
        ]);

        // ✅ CORRECT SESSION STORAGE
        $request->session()->put('exam_questions', $questions->pluck('id')->toArray());
        $request->session()->put('attempt_id', $attempt->id);
        $request->session()->put('current_index', 0);
        $request->session()->put('exam_end_time', now()->addMinutes($exam->duration));

        return redirect()->route('student.exam.question');
    }

    public function available()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $query = Exam::query();

        if ($user->studentDetail?->school_id) {

            $query->where('school_id', $user->studentDetail->school_id)
                ->where('class_id', $user->studentDetail->class_id);

        } else {

            $query->whereNull('school_id');
        }

        $exams = $query->get();

        return view('student.exam.index', compact('exams'));
    }

    public function question(Request $request)
    {
        $questions = $request->session()->get('exam_questions');
        $index = $request->session()->get('current_index');

        if (!$questions || !isset($questions[$index])) {
            return redirect()->route('student.exam.submit.auto');
        }

        $questionId = $questions[$index];

        $question = Question::with('options')->find($questionId);

        return view('student.exam.question', compact('question','index'));
    }

    public function answer(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'answer' => 'required'
        ]);

        // ✅ Get session data
        $attemptId = $request->session()->get('attempt_id');
        $questions = $request->session()->get('exam_questions');
        $index = (int) $request->session()->get('current_index', 0);

        // ✅ Safety check
        if (!$questions || !isset($questions[$index])) {
            return redirect()->route('student.exam.submit.auto');
        }

        $questionId = $questions[$index];

        $question = Question::find($questionId);

        if (!$question) {
            return redirect()->route('student.exam.submit.auto');
        }

        // ✅ Check answer (works for both objective & fill)
        $isCorrect = strtolower(trim($question->correct_answer)) 
            == strtolower(trim($request->answer));

        // ✅ Save answer
        Answer::updateOrCreate(
            [
                'attempt_id' => $attemptId,
                'question_id' => $questionId
            ],
            [
                'selected_option' => $request->answer,
                'is_correct' => $isCorrect
            ]
        );

        // ✅ Move to next question
        $nextIndex = $index + 1;

        if (!isset($questions[$nextIndex])) {
            return redirect()->route('student.exam.submit.auto');
        }

        $request->session()->put('current_index', $nextIndex);

        return redirect()->route('student.exam.question');
    }

    public function submitAuto()
    {
        $attempt = ExamAttempt::find(session('attempt_id'));

        if (!$attempt) {
            return redirect()->route('dashboard')
                ->with('error', 'Session expired.');
        }

        $score = Answer::where('attempt_id', $attempt->id)
            ->where('is_correct', 1)
            ->count();

        $attempt->update([
            'score' => $score,
            'submitted_at' => now(),
            'status' => 'completed'
        ]);

        session()->forget([
            'exam_questions',
            'attempt_id',
            'current_index',
            'exam_end_time'
        ]);

        return redirect()->route('student.exam.result', $attempt->id);
    }

    public function result($id)
    {
        $attempt = ExamAttempt::with('exam')->findOrFail($id);

        return view('student.exam.result', compact('attempt'));
    }
}