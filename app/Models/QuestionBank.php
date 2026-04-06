<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    // protected $fillable = [
    //     'subject_id',
    //     'topic_id',
    //     'class_level_id',
    //     'passage_id',
    //     'exam_type',
    //     'question_type',
    //     'question_text',
    //     'difficulty',
    //     'year',
    //     'time_limit',
    //     'correct_answer',
    //     'explanation',
    //     'created_by',
    //     'school_id',
    //     'source'
    // ];

    protected $fillable = [
    'subject_id',
    'topic_id',
    'class_level_id',
    'question_type',
    'question_text',
    'correct_answer',
    'difficulty',
    'explanation',
    'created_by',
    'source'
];

    public function options()
    {
        return $this->hasMany(\App\Models\Option::class);
    }
}
