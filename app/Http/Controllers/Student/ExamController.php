<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamAttempt;
use App\Models\Answer;
use App\Models\User;

use Maatwebsite\Excel\Facades\Empty;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ExamController extends Controller
{
    // start exam
    public function start(Request $request, $examId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $exam = Exam::findOrFail($examId);

        $studentId = $user->id;

        // get correct answers
        $correct = DB::table('student_question_attempts')
            ->where('student_id', $studentId)
            ->where('topic_id', $request->topic_id)
            ->where('is_correct', 1)
            ->pluck('question_id');

        // 🚨 DO NOT use ->get() here
        $query = Question::where('subject_id', $exam->subject_id)
            ->whereNotIn('id', $correct);

        // 🔁 If everything is done
        if ($query->count() == 0) {

            DB::table('student_question_attempts')
                ->where('student_id', $studentId)
                ->where('topic_id', $request->topic_id)
                ->delete();

            $query = Question::where('subject_id', $exam->subject_id);
        }

        // role filtering (still query builder)
        if ($user->role === 'student') {

            if ($user->studentDetail?->school_id) {

                $query->where('source', 'internal')
                    ->where('school_id', $user->studentDetail->school_id)
                    ->where('class_level_id', $user->studentDetail->class_id);

            } else {

                $query->where('source', 'external');
            }
        }

        $total = $exam->total_questions;

        // ✅ NOW fetch data
        $questions = $query->inRandomOrder()->take($total)->get();

        // fallback if not enough
        if ($questions->count() < $total) {
            $questions = $query->inRandomOrder()->get();
        }

        if ($questions->isEmpty()) {
            return back()->with('error', 'No questions available for this exam.');
        }

        // create attempt
        $attempt = ExamAttempt::create([
            'user_id' => $studentId,
            'subject_id' => $exam->subject_id,
            'exam_id' => $exam->id,
            'total' => $questions->count(),
            'started_at' => now()
        ]);

        // session
        $request->session()->put('exam_questions', $questions->pluck('id')->toArray());
        $request->session()->put('attempt_id', $attempt->id);
        $request->session()->put('current_index', 0);
        $request->session()->put('exam_end_time', now()->addMinutes($exam->duration));

        return redirect()->route('student.exam.question');
    }
    // available exams
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

    // questions
    public function question(Request $request)
    {
        $questions = $request->session()->get('exam_questions');
        $index = $request->session()->get('current_index');

        if (!$questions || !isset($questions[$index])) {
            return redirect()->route('student.exam.submit.auto');
        }

        $questionId = $questions[$index];

        $question = Question::with('teacher_options')->find($questionId);

        return view('student.exam.question', compact('question','index'));
    }

    // answer
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

        // save attempt
        DB::table('student_question_attempts')
        ->updateOrInsert(

            [
                'student_id'  => auth()->id(),
                'question_id' => $questionId
            ],

            [
                'topic_id'       => $question->topic_id,
                'is_correct'     => $isCorrect ? 1 : 0,
                'last_answer'    => $request->answer,
                'attempts_count' => DB::raw('attempts_count + 1'),
                'updated_at'     => now(),
                'attempted_at'   => now()
            ]
        );    

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

    // auto submit
    public function autoSubmit()
    {
        $attempt = ExamAttempt::find(session('attempt_id'));

        if (!$attempt) {
            return redirect()->route('student.exams.available')
                ->with('error', 'Session expired.');
        }

        $score = Answer::where('attempt_id', $attempt->id)
            ->distinct('question_id')
            ->where('is_correct', 1)
            ->count('question_id');

        $exam = \App\Models\Exam::find($attempt->exam_id);

        $student = auth()->user()->studentDetail;

        if ($exam && $student) {

            $result = \App\Models\ResultScore::firstOrCreate(

                [
                    'school_id'           => $student->school_id,
                    'student_details_id'  => $student->id,
                    'class_id'            => $student->class_id,
                    'subject_id'          => $exam->subject_id,
                    'session'             => $exam->session,
                    'term'                => $exam->term,
                ],

                [
                    'created_by' => auth()->id()
                ]
            );

            if ($exam->score_type == 'first_ca') {

                $result->first_ca_score = $score;

            } elseif ($exam->score_type == 'second_ca') {

                $result->second_ca_score = $score;

            } elseif ($exam->score_type == 'exam') {

                $result->exam_score = $score;
            }

            $result->total_score =
                ($result->first_ca_score ?? 0) +
                ($result->second_ca_score ?? 0) +
                ($result->exam_score ?? 0);
                
                // total score
                if ($result->total_score >= 70) $grade = 'A';
                elseif ($result->total_score >= 60) $grade = 'B';
                elseif ($result->total_score >= 50) $grade = 'C';
                elseif ($result->total_score >= 45) $grade = 'D';
                elseif ($result->total_score >= 40) $grade = 'E';
                else $grade = 'F';

                $result->grade = $grade;

            $result->save();
        }

        $student = auth()->user()->studentDetail;

        if (
            $exam &&
            $exam->exam_cat_id == 2 &&
            $student
        ) {

            \App\Models\ResultScore::updateOrCreate(

                [
                    'student_details_id' => $student->id,
                    'subject_id'         => $attempt->subject_id,
                    'term'               => $exam->term,
                    'session'            => $exam->session
                ],

                [
                    'school_id'   => $student->school_id,
                    'class_id'    => $student->class_id,
                    'exam_score'  => $score,
                    'created_by'  => auth()->id()
                ]
            );
        }    

        $attempt->update([
            'score' => $score,
            'submitted_at' => now(),
            'status' => 'completed'
        ]);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Completed CBT exam'
        ]);

        session()->forget([
            'exam_questions',
            'attempt_id',
            'current_index',
            'exam_end_time'
        ]);

        // ✅ REDIRECT TO RESULT (NOT DASHBOARD)
        return redirect()->route('student.exam.result', $attempt->id);
    }

    // results
    public function result($id)
    {
        $attempt = ExamAttempt::with('exam')->findOrFail($id);

        return view('student.exam.result', compact('attempt'));
    }

    
    // download pdf 
    public function downloadResult($id)
    {
        $attempt = ExamAttempt::with('exam','user')->findOrFail($id);

        $pdf = Pdf::loadView('student.exam.pdf', compact('attempt'));

        return $pdf->download('result.pdf');
    }

    public function analytics()
    {
        $data = ExamAttempt::selectRaw('DATE(created_at) as date, AVG(score) as avg_score')
            ->groupBy('date')
            ->get();

        return view('student.analytics', compact('data'));
    }

    public function review($id)
    {
        $attempt = ExamAttempt::with([
            'answers.question.teacher_options'
        ])->findOrFail($id);

        return view('student.exam.review', compact('attempt'));
    }

    public function toggleSave($id)
    {
        $studentId = auth()->id();

        $exists = DB::table('saved_questions')
            ->where('student_id', $studentId)
            ->where('question_id', $id)
            ->first();

        if ($exists) {

            DB::table('saved_questions')
                ->where('id', $exists->id)
                ->delete();

            return response()->json([
                'status' => 'removed'
            ]);

        } else {

            DB::table('saved_questions')->insert([
                'student_id' => $studentId,
                'question_id' => $id
            ]);

            return response()->json([
                'status' => 'saved'
            ]);
        }
    }

    public function savedQuestions()
    {
        $rows = DB::table('saved_questions as s')
            ->join('questions as q', 'q.id', '=', 's.question_id')
            ->where('s.student_id', auth()->id())
            ->select('q.*')
            ->get();

        return view('student.archive.index', compact('rows'));
    }

    public function weakTopics()
    {
        $studentId = auth()->id();

        $topics = DB::table('student_question_attempts as s')
            ->join('topics as t', 't.id', '=', 's.topic_id')
            ->select(
                't.id',
                't.topic',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(s.is_correct) as correct')
            )
            ->where('s.student_id', $studentId)
            ->groupBy('t.id', 't.topic')
            ->get()
            ->map(function ($row) {

                $accuracy = $row->total > 0
                    ? ($row->correct / $row->total) * 100
                    : 0;

                $row->accuracy = round($accuracy, 2);

                return $row;
            });

        // 🎯 weak topics (< 50%)
        $weak = $topics->where('accuracy', '<', 50);

        return view(
            'student.analytics.weak-topics',
            compact('topics', 'weak')
        );
    }

}