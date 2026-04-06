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
        'exam_cat_id',
        'duration',
        'total_questions'
    ];
    
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }
}
