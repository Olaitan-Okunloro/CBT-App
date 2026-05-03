<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
  
    protected $fillable = [
        'title',
        'subject_id',
        'class_id',
        'school_id',
        'created_by',
        'exam_cat_id',
        'term',
        'session',
        'score_type',
        'duration',
        'total_questions',
        'total_marks',
        'mark_per_question'
    ];
    
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }
}
