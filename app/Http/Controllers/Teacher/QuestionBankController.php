<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
// use App\Models\Subject;
// use App\Models\ClassLevel;
// use App\Models\TeacherDetail;
// use App\Models\Option;

class QuestionBankController extends Controller
{

    public function index()
    {
        $questions = \App\Models\Question::latest()->paginate(20);

        return view('teacher.questions.bank', compact('questions'));
    }

    public function import(Request $request)
    {
        $teacher = auth()->user()->teacherDetail;

        foreach ($request->question_ids as $id) {

            $bank = \App\Models\QuestionBank::with('options')->find($id);

            $question = \App\Models\Question::create([
                'subject_id' => $bank->subject_id,
                'class_level_id' => $teacher->class_id,
                'school_id' => $teacher->school_id,
                'question_type' => $bank->question_type,
                'question_text' => $bank->question_text,
                'correct_answer' => $bank->correct_answer,
                'source' => 'internal',
                'difficulty' => $bank->difficulty,
                'explanation' => $bank->explanation,
                'created_by' => auth()->id(),
            ]);

            foreach ($bank->options as $opt) {
                \App\Models\Option::create([
                    'question_id' => $question->id,
                    'option_label' => $opt->option_label,
                    'option_text' => $opt->option_text,
                ]);
            }
        }

        return back()->with('success', 'Questions imported successfully');
    }
}
