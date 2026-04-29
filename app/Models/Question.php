<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'subject_id',
        'topic_id',
        'class_level_id',
        'passage_id',
        'exam_cat_id',
        'exam_type',
        'question_type',
        'question_text',
        'difficulty',
        'year',
        'time_limit',
        'correct_answer',
        'explanation',
        'created_by',
        'school_id',
        'source',
        'status'
    ];

    public function teacher_options()
    {
        return $this->hasMany(\App\Models\TeacherOption::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }

    public function options()
    {
        return $this->hasMany(\App\Models\TeacherOption::class, 'question_id');
    }

    public function classLevel()
    {
        return $this->belongsTo(
            \App\Models\ClassLevel::class
        );
    }

    // public function subject()
    // {
    //     return $this->belongsTo(\App\Models\Subject::class);
    // }

    // public function classLevel()
    // {
    //     return $this->belongsTo(\App\Models\ClassLevel::class);
    // }

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class);
    }

    // public function options()
    // {
    //     return $this->hasMany(\App\Models\Option::class, 'question_id');
    // }

}

