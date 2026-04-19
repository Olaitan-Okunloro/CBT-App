<?php
// app/Models/StudentDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $table = 'student_details';

    protected $fillable = [
        'user_id',
        'registration_number',
        'has_paid',
        'email_sub',
        'payment_reference',
        'payment_date',
        'payment_expiry',
        'school_id',
        'class_id',
        'teacher_id',
        'face_photo',
        'face_descriptor',
        'referrer_code_used',
        'referral_user_id'
    ];

    protected $casts = [
        'has_paid' => 'boolean',
        'payment_date' => 'datetime',
        'payment_expiry' => 'date'
    ];

    // Add this relationship

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassLevel::class, 'class_id');
    }
}