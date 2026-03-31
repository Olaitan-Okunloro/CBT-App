<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'question_id',
        'option_label',
        'option_text'
    ];

    public function question()
    {
        return $this->belongsTo(\App\Models\QuestionBank::class);
    }
}
