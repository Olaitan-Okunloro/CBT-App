<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'referrer_id',
        'student_id',
        'payment_id',
        'amount',
        'type'
    ];
}