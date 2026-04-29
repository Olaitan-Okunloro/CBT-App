<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{

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

    public function teacher_options()
    {
        return $this->hasMany(
            \App\Models\TeacherOption::class,
            'question_id'
        );
    }

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }

    public function classLevel()
    {
        return $this->belongsTo(\App\Models\ClassLevel::class);
    }

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }


    public function options()
    {
        return $this->hasMany(\App\Models\Option::class,'question_id', 'id');
    }
}
