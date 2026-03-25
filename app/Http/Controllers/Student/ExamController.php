<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamAttempt;

class ExamController extends Controller
{
    public function start($examId)
    {
        $user = auth()->user();

        $exams = Exam::findOrFail($examId);

        // 🔥 FILTER QUESTIONS (your logic)
        $query = Question::where('subject_id', $exam->subject_id);

        if ($user->role === 'student') {

            if ($user->studentDetail && $user->studentDetail->school_id) {

                $query->where('source', 'internal')
                    ->where('school_id', $user->studentDetail->school_id)
                    ->where('class_level_id', $user->studentDetail->class_id);

            } else {

                $query->where('source', 'external');
            }
        }

        $questions = $query->inRandomOrder()
            ->limit($exam->total_questions)
            ->get();

        // Create attempt
        $attempt = ExamAttempt::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'total' => $questions->count(),
            'started_at' => now()
        ]);
        
        session([
            'exam_questions' => $questions,
            'attempt_id' => $attempt->id,
            'exam_end_time' => now()->addMinutes($exam->duration)
        ]);

        return view('student.exam.start', compact('exams','questions','attempt'));
    }

    public function available()
    {
        $user = auth()->user();

        $query = Exam::query();

        // 👇 INTERNAL (school students)
        if ($user->studentDetail && $user->studentDetail->school_id) {

            $query->where('school_id', $user->studentDetail->school_id)
                ->where('class_id', $user->studentDetail->class_id);

        } else {

            // 👇 EXTERNAL students
            $query->whereNull('school_id');
        }

        $exams = $query->get();

        return view('student.exam.index', compact('exams'));
    }

    public function submit(Request $request)
    {
        $attempt = ExamAttempt::findOrFail($request->attempt_id);

        $answers = $request->answers;

        $score = 0;

        foreach($answers as $questionId => $selected){

            $question = Question::find($questionId);

            $isCorrect = $question->correct_answer == $selected;

            if($isCorrect){
                $score++;
            }

            Answer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $questionId,
                'selected_option' => $selected,
                'is_correct' => $isCorrect
            ]);
        }

        $attempt->update([
            'score' => $score,
            'submitted_at' => now(),
            'status' => 'completed'
        ]);

        return redirect()->route('student.exam.result', $attempt->id);
    }

    public function result($id)
    {
        $attempt = ExamAttempt::with('exam')->findOrFail($id);

        return view('student.exam.result', compact('attempt'));
    }

    
    // question 
    public function question()
    {

        if (now()->greaterThan(session('exam_end_time'))) {
            return redirect()->route('student.exam.submit.auto');
        }

        $questions = session('exam_questions');
        $index = session('current_index');

        if (!isset($questions[$index])) {
            return redirect()->route('student.exam.submit.auto');
        }

        $question = \App\Models\Question::with('options')
            ->find($questions[$index]);

        return view('student.exam.question', compact('question','index'));
    }

    // save answer and move to the next question
    public function answer(Request $request)
    {
        $attemptId = session('attempt_id');
        $questions = session('exam_questions');
        $index = session('current_index');

        $questionId = $questions[$index];

        $question = Question::find($questionId);

        $isCorrect = $question->correct_answer == $request->answer;

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

        // Move to next question
        session(['current_index' => $index + 1]);

        return redirect()->route('student.exam.question');

        if (!session()->has('attempt_id')) {
            return redirect()->route('dashboard');
        }
    }

    public function submitAuto()
    {
        $attempt = ExamAttempt::find(session('attempt_id'));

        $score = Answer::where('attempt_id', $attempt->id)
            ->where('is_correct', 1)
            ->count();

        $attempt->update([
            'score' => $score,
            'submitted_at' => now(),
            'status' => 'completed'
        ]);

        session()->forget(['exam_questions','attempt_id','current_index']);

        return redirect()->route('student.exam.result', $attempt->id);
    }
}
