<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Option;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionsImport implements ToModel
{
    public function model(array $row)
    {
        $question = Question::create([
        'subject_id'=>$row[0],
        'class_level_id'=>$row[1],
        'question_type'=>$row[2],
        'question_text'=>$row[3],
        'difficulty'=>$row[4],
        'time_limit'=>$row[5],
        'correct_answer'=>$row[10]

        ]);

        Option::create([
        'question_id'=>$question->id,
        'option_label'=>'A',
        'option_text'=>$row[6]
        ]);

        Option::create([
        'question_id'=>$question->id,
        'option_label'=>'B',
        'option_text'=>$row[7]
        ]);

        Option::create([
        'question_id'=>$question->id,
        'option_label'=>'C',
        'option_text'=>$row[8]
        ]);

        Option::create([
        'question_id'=>$question->id,
        'option_label'=>'D',
        'option_text'=>$row[9]
        ]);

    }

    public function import(Request $request)
    {

    Excel::import(new QuestionsImport,$request->file('file'));

    return back()->with('success','Questions uploaded successfully');

    }
}

