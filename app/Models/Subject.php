<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    public function ExamAttempt()
    {
        return $this->hasMany(ExamAttempt::class, 'attempt_id');
    }

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function studentResult()
    {
        return $this->hasMany(ResultScore::class);
    }

    public function questionBanks()
    {
        return $this->hasMany(\App\Models\QuestionBank::class, 'subject_id');
    }
}

