<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamCategory;

class ExamController extends Controller
{
    public function create()
    {
        $categories = ExamCategory::all();

        return view('teacher.exams.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required',
            'exam_cat_id' => 'required',
            'total_questions' => 'required|integer',
            'duration' => 'required|integer'
        ]);

        $teacher = auth()->user()->teacherDetail;

        Exam::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'class_id' => $teacher->class_id,
            'school_id' => $teacher->school_id,
            'exam_cat_id' => $request->exam_cat_id,
            'total_questions' => $request->total_questions,
            'duration' => $request->duration
        ]);
        // dd($request);
        return back()->with('success', 'Exam created successfully');
    }
}
