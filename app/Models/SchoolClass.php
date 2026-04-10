<?php
// app/Models/SchoolClass.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'school_classes';

    protected $fillable = [
        'school_id',
        'class_level_id',  // Changed from class_id
    ];

    protected $casts = [
        'school_id' => 'integer',
        'class_level_id' => 'integer',  // Changed from class_id
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function classLevel()
    {
        return $this->belongsTo(ClassLevel::class, 'class_level_id');  // Changed foreign key
    }
}