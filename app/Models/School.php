<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name',
    'address', 
    'registration_number',
    'referrer_code_used',
    'referral_user_id'
    ];

    public function schoolDetails()
    {
        return $this->hasMany(SchoolDetail::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'school_details');
    }

    public function teachers()
    {
        return $this->hasMany(TeacherDetail::class);
    }

    public function students()
    {
        return $this->hasMany(StudentDetail::class);
    }
}
