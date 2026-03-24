<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use App\Models\Option;

class QuestionController extends Controller
{
    // create questions
    public function create()
    {
        $subjects = Subject::all();
        $classes = ClassLevel::all();
        return view('teacher.questions.create', compact('subjects','classes'));
    }

    // store function
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'class_level_id' => 'required',
            'question_text' => 'required',
            'correct_answer' => 'required',
            'difficulty' => 'required'
        ]);

        $teacher = auth()->user()->teacherDetail;

        $question = Question::create([
            'subject_id' => $request->subject_id,
            'class_level_id' => $request->class_level_id,
            'school_id' => $teacher->school_id,
            'question_type' => $request->question_type,
            'question_text' => $request->question_text,
            
            'correct_answer' => $request->correct_answer,
            'created_by' => auth()->id(),
            'source' => 'internal'
        ]);

        if($request->question_type === 'objective'){

            Option::create(['question_id'=>$question->id,'option_label'=>'A','option_text'=>$request->option_a]);
            Option::create(['question_id'=>$question->id,'option_label'=>'B','option_text'=>$request->option_b]);
            Option::create(['question_id'=>$question->id,'option_label'=>'C','option_text'=>$request->option_c]);
            Option::create(['question_id'=>$question->id,'option_label'=>'D','option_text'=>$request->option_d]);
        }

        return back()->with('success','Question added successfully');
    }

}
