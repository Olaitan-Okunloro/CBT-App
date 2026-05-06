<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'class_level_id',
        'subject_id',
        'topic'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class);
    }

    public function questionBanks()
    {
        return $this->hasMany(\App\Models\QuestionBank::class, 'topic_id');
    }
}
