<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolDetail extends Model
{
    protected $fillable = [
        'user_id',
        'school_id',
        'has_paid'
    ];

    // relashionship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // app/Models/StudentDetail.php

    public function isInternal()
    {
        return !is_null($this->school_id);
    }

    public function isExternal()
    {
        return is_null($this->school_id);
    }
}
