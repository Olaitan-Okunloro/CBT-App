<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'exam_id',
        'score',
        'total',
        'started_at',
        'submitted_at',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'attempt_id');
    }

    public function subject()
    {
        return $this->hasMany(Subject::class, 'id');
    }
}