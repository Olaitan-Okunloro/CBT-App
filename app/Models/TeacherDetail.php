<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherDetail extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'school_id',
        'has_paid',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
