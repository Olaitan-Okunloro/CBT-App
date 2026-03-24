<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

        protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'exam_type', 
        'role',
        'address',
        'profile_photo',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function studentDetail()
    {
        return $this->hasOne(StudentDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }

    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function schoolDetail()
    {
        return $this->hasOne(SchoolDetail::class);
    }

    public function teacherDetail()
    {
        return $this->hasOne(TeacherDetail::class);
    }

    public function school()
    {
        return $this->belongsToMany(School::class, 'school_details');
    }
}