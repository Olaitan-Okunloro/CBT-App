<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultScore extends Model
{
    protected $table = 'result_scores';

    protected $fillable = [
        'school_id',
        'student_details_id',
        'class_id',
        'subject_id',
        'session',
        'term',
        'test_score',
        'exam_score',
        'total_score',
        'grade',
        'remark'
    ];

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
    }

    public function student()
    {
        return $this->belongsTo(
            \App\Models\StudentDetail::class,
            'student_details_id'
        );
    }
}