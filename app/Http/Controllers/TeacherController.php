<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        // Get teacher school
        return view('dashboard.teacher');
    }
}
