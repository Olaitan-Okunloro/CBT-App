<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passage extends Model
{
    protected $fillable = [
        'title',
        'content',
        'class_level_id',
        'created_by'
    ];
}
