<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{
    protected $fillable = [
        'attempt_id',
        'question_id',
        'selected_option',
        'is_correct',
        'question_source'
    ];

    public function attempt()
    {
        return $this->belongsTo(ExamAttempt::class, 'attempt_id');
    }

    public function question()
    {
        if (($this->question_source ?? '') === 'question_bank') {

            return $this->belongsTo(
                \App\Models\QuestionBank::class,
                'question_id'
            );
        }

        return $this->belongsTo(
            \App\Models\Question::class,
            'question_id'
        );
    }
}

