<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_details_id',
        'date',
        'check_in_time',
        'check_out_time',
        'status',
        'created_by'
    ];

    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_details_id', 'id');
    }
}