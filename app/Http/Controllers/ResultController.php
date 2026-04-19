<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\ResultScore;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    // ResultController.php

    public function create()
    {
        $students = \App\Models\StudentDetail::with(['user'])->get();

        $subjects = \App\Models\Subject::all();

        return view('teacher.results.create', compact(
            'students',
            'subjects'
        ));
    }

    public function store(Request $request)
    {
        foreach ($request->rows as $row) {

            $existing = \App\Models\ResultScore::where('student_details_id', $row['student_id'])
                ->where('subject_id', $row['subject_id'])
                ->where('session', $request->session)
                ->where('term', $request->term)
                ->first();

            if (!$existing) {

                $existing = new \App\Models\ResultScore();
                $existing->school_id = auth()->user()->school_id ?? 1;
                $existing->student_details_id = $row['student_id'];
                $existing->class_id = $row['class_id'];
                $existing->subject_id = $row['subject_id'];
                $existing->session = $request->session;
                $existing->term = $request->term;
                $existing->test_score = 0;
                $existing->exam_score = 0;
            }

            if ($request->upload_type == 'test') {
                $existing->test_score = $row['score'];
            } else {
                $existing->exam_score = $row['score'];
            }

            $existing->total_score =
                $existing->test_score + $existing->exam_score;

            $total = $existing->total_score;

            if ($total >= 70) {
                $existing->grade = 'A';
                $existing->remark = 'Excellent';
            } elseif ($total >= 60) {
                $existing->grade = 'B';
                $existing->remark = 'Very Good';
            } elseif ($total >= 50) {
                $existing->grade = 'C';
                $existing->remark = 'Good';
            } elseif ($total >= 45) {
                $existing->grade = 'D';
                $existing->remark = 'Fair';
            } elseif ($total >= 40) {
                $existing->grade = 'E';
                $existing->remark = 'Pass';
            } else {
                $existing->grade = 'F';
                $existing->remark = 'Fail';
            }    

            $existing->save();
        }

        return back()->with('success', 'Scores uploaded successfully');
    }

    public function checker()
    {
        return view('student.results.checker');
    }

    public function showResult(Request $request)
    {
        $student = \App\Models\StudentDetail::where(
            'registration_number',
            $request->registration_number
        )->first();

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

        $results = \App\Models\ResultScore::with('subject')
            ->where('student_details_id', $student->id)
            ->where('session', $request->session)
            ->where('term', $request->term)
            ->get();

            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Checked result online'
            ]);

        if ($results->isEmpty()) {
            return back()->with('error', 'No result found');
        }

        return view('student.results.show', compact('student', 'results'));
    }
}