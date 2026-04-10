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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'subject_id' => 'required',
    //         'class_id' => 'required',
    //         'exam_cat_id' => 'required',
    //         'total_questions' => 'required|integer',
    //         'duration' => 'required|integer'
    //     ]);

    //     $teacher = auth()->user()->teacherDetail;

    //     Exam::create([
    //         'title' => $request->title,
    //         'subject_id' => $request->subject_id,
    //         'class_id' => $request->class_id,
    //         'school_id' => $teacher->school_id,
    //         'exam_cat_id' => $request->exam_cat_id,
    //         'total_questions' => $request->total_questions,
    //         'duration' => $request->duration
    //     ]);
    //     // dd($request);
    //     return back()->with('success', 'Exam created successfully');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'exams' => 'required|array',
            'exams.*.title' => 'required|string|max:255',
            'exams.*.class_id' => 'required|exists:classes,id',
            'exams.*.subject_id' => 'required|exists:subjects,id',
            'exams.*.exam_cat_id' => 'required|exists:exam_categories,id',
            'exams.*.total_questions' => 'required|integer|min:1',
            'exams.*.duration' => 'required|integer|min:1',
        ]);

        $teacher = auth()->user()->teacherDetail;
        $savedCount = 0;
        $errors = [];

        foreach ($request->exams as $index => $examData) {
            try {
                // Create the exam
                $exam = Exam::create([
                    'title' => $examData['title'],
                    'class_id' => $examData['class_id'],
                    'subject_id' => $examData['subject_id'],
                    'exam_cat_id' => $examData['exam_cat_id'],
                    'total_questions' => $examData['total_questions'],
                    'duration' => $examData['duration'],
                    'teacher_id' => $teacher->id,
                    'school_id' => $teacher->school_id,
                    'is_published' => false,
                    'created_by' => auth()->id(),
                ]);
                
                $savedCount++;
                
            } catch (\Exception $e) {
                $errors[] = "Exam #" . ($index + 1) . " (Title: {$examData['title']}) failed: " . $e->getMessage();
            }
        }

        if ($savedCount > 0) {
            $message = "$savedCount exam(s) created successfully!";
            
            if (!empty($errors)) {
                $message .= " But some failed: " . implode('; ', $errors);
                return redirect()->route('teacher.exams.index')->with('warning', $message);
            }
            
            return redirect()->route('teacher.exams.create')->with('success', $message);
        }
        
        return redirect()->back()->with('error', 'Failed to create exams: ' . implode('; ', $errors));
    }
}
