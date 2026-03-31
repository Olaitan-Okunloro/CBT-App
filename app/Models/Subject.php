<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'class_level_id',
        'created_by'
    ];

    public function ExamAttempt()
    {
        return $this->hasMany(ExamAttempt::class, 'attempt_id');
    }
}

