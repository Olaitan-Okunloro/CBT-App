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


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'exams' => 'required|array',
    //         'exams.*.title' => 'required|string|max:255',
    //         'exams.*.class_id' => 'required|exists:classes,id',
    //         'exams.*.subject_id' => 'required|exists:subjects,id',
    //         'exams.*.exam_cat_id' => 'required|exists:exam_categories,id',
    //         'exams.*.total_questions' => 'required|integer|min:1',
    //         'exams.*.duration' => 'required|integer|min:1',
    //     ]);

    //     $teacher = auth()->user()->teacherDetail;
    //     $savedCount = 0;
    //     $errors = [];

    //     foreach ($request->exams as $index => $examData) {
    //         try {
    //             // Create the exam
    //             $exam = Exam::create([
    //                 'title' => $examData['title'],
    //                 'class_id' => $examData['class_id'],
    //                 'subject_id' => $examData['subject_id'],
    //                 'exam_cat_id' => $examData['exam_cat_id'],
    //                 'total_questions' => $examData['total_questions'],
    //                 'duration' => $examData['duration'],
    //                 'teacher_id' => $teacher->id,
    //                 'school_id' => $teacher->school_id,
    //                 'is_published' => false,
    //                 'created_by' => auth()->id(),
    //             ]);
                
    //             $savedCount++;
                
    //         } catch (\Exception $e) {
    //             $errors[] = "Exam #" . ($index + 1) . " (Title: {$examData['title']}) failed: " . $e->getMessage();
    //         }
    //     }

    //     if ($savedCount > 0) {
    //         $message = "$savedCount exam(s) created successfully!";
            
    //         if (!empty($errors)) {
    //             $message .= " But some failed: " . implode('; ', $errors);
    //             return redirect()->route('teacher.exams.index')->with('warning', $message);
    //         }
            
    //         return redirect()->route('teacher.exams.create')->with('success', $message);
    //     }
        
    //     return redirect()->back()->with('error', 'Failed to create exams: ' . implode('; ', $errors));
    // }

    public function store(Request $request)
    {
        $request->validate([

            'exams' => 'required|array',

            'exams.*.title' => 'required|string|max:255',
            'exams.*.class_id' => 'required|exists:classes,id',
            'exams.*.subject_id' => 'required|exists:subjects,id',
            'exams.*.exam_cat_id' => 'required|exists:exam_categories,id',

            'exams.*.number_of_questions' =>
                'required|integer|min:1',

            'exams.*.mark_per_question' =>
                'required|integer|min:1',

            'exams.*.duration' =>
                'required|integer|min:1',

            'exams.*.term' =>
                'required|string|max:50',

            'exams.*.session' =>
                'required|string|max:50',

            'exams.*.score_type' =>
                'required|string|max:50',
        ]);

        $teacher = auth()->user()->teacherDetail;

        if (!$teacher) {
            return back()->with(
                'error',
                'Teacher profile not found.'
            );
        }

        $savedCount = 0;
        $errors = [];

        foreach ($request->exams as $index => $examData) {

            try {

                $totalQuestions =
                    (int) $examData['number_of_questions'];

                $markPerQuestion =
                    (int) $examData['mark_per_question'];

                $totalMarks =
                    $totalQuestions *
                    $markPerQuestion;

                Exam::create([

                    'title' => trim($examData['title']),

                    'class_id' => $examData['class_id'],

                    'subject_id' => $examData['subject_id'],

                    'exam_cat_id' => $examData['exam_cat_id'],

                    'total_questions' => $totalQuestions,

                    'total_marks' => $totalMarks,

                    'duration' => $examData['duration'],

                    'term' => trim($examData['term']),

                    'session' => trim($examData['session']),

                    'score_type' => trim($examData['score_type']),

                    'mark_per_question' => $markPerQuestion,

                    'teacher_id' => $teacher->id,

                    'school_id' => $teacher->school_id,
                    
                    'created_by' => auth()->id(),

                    'is_published' => false,

                ]);

                $savedCount++;

            } catch (\Exception $e) {

                $errors[] =
                    'Exam #' . ($index + 1) .
                    ' failed: ' .
                    $e->getMessage();
            }
        }

        if ($savedCount > 0) {

            $message =
                $savedCount .
                ' exam(s) created successfully!';

            if (!empty($errors)) {

                $message .=
                    ' Some failed: ' .
                    implode('; ', $errors);

                return redirect()
                    ->route('teacher.exams.index')
                    ->with('warning', $message);
            }

            return redirect()
                ->route('teacher.exams.create')
                ->with('success', $message);
        }

        return back()->with(
            'error',
            'No exam was created. ' .
            implode('; ', $errors)
        );
    }
}
