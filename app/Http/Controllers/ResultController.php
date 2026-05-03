<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\ResultScore;

use Barryvdh\DomPDF\Facade\Pdf;
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

            $result = \App\Models\ResultScore::where('student_details_id', $row['student_id'])
                ->where('subject_id', $row['subject_id'])
                ->where('session', $request->session)
                ->where('term', $request->term)
                ->first();

            if (!$result) {

                $result = new \App\Models\ResultScore();

                $result->school_id = auth()->user()->school_id ?? 1;
                $result->student_details_id = $row['student_id'];
                $result->class_id = $row['class_id'];
                $result->subject_id = $row['subject_id'];
                $result->created_by = auth()->user()->id;
                $result->session = $request->session;
                $result->term = $request->term;

                // initialize scores
                $result->first_ca_score = 0;
                $result->second_ca_score = 0;
                $result->exam_score = 0;
            }

            // 🎯 Flexible CA logic
            if ($request->upload_type == 'first_ca') {

                $result->first_ca_score = $row['score'];

            } elseif ($request->upload_type == 'second_ca') {

                $result->second_ca_score = $row['score'];

            } elseif ($request->upload_type == 'exam') {

                $result->exam_score = $row['score'];
            }

            // 🎯 Total score
            $result->total_score =
                ($result->first_ca_score ?? 0) +
                ($result->second_ca_score ?? 0) +
                ($result->exam_score ?? 0);

            // 🎯 Grade system
            $total = $result->total_score;

            if ($total >= 70) {
                $result->grade = 'A';
                $result->remark = 'Excellent';
            } elseif ($total >= 60) {
                $result->grade = 'B';
                $result->remark = 'Very Good';
            } elseif ($total >= 50) {
                $result->grade = 'C';
                $result->remark = 'Good';
            } elseif ($total >= 45) {
                $result->grade = 'D';
                $result->remark = 'Fair';
            } elseif ($total >= 40) {
                $result->grade = 'E';
                $result->remark = 'Pass';
            } else {
                $result->grade = 'F';
                $result->remark = 'Fail';
            }

            $result->save();
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

        $school = null;

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

        if ($student && $student->school_id) {
            $school = \App\Models\School::find($student->school_id);
        }

        $attendanceRows = \App\Models\Attendance::where(
        'student_details_id',
        $student->id
            )
            ->whereMonth('date', now()->month)
            ->get();

        $presentDays = $attendanceRows->count();

        $lateDays = $attendanceRows
            ->where('status', 'late')
            ->count();

        $schoolDays = 60; // adjust or make dynamic later

        $absentDays = max($schoolDays - $presentDays, 0);

        $attendanceRate = $schoolDays > 0
            ? round(($presentDays / $schoolDays) * 100, 2)
            : 0;

        $currentClass = $student->class_id;
        $nextClass = ++$currentClass;

        $findClass = DB::table('classes')
        ->where('id', $nextClass)->first();

        $newClass = $findClass->name;

        // new code
        $fee = DB::table('school_fees')
        ->where('school_id', $student->school_id)
        ->where('class_id', $student->class_id)
        ->latest()
        ->first();

        $books = DB::table('school_books')
            ->where('school_id', $student->school_id)
            ->where('class_id', $student->class_id)
            ->latest()
            ->first();

        $paid = DB::table('school_fee_payments')
            ->where('student_id', $student->user_id)
            ->where('status', 'confirmed')
            ->sum('amount');

        $totalFee = 0;

        if ($fee) {
            $totalFee =
                ($fee->tuition ?? 0) +
                ($fee->uniforms ?? 0) +
                ($fee->sports_wear ?? 0) +
                ($fee->books ?? 0) +
                ($fee->exam_fee ?? 0) +
                ($fee->pta_levy ?? 0) +
                ($fee->other_fee ?? 0);
        }

        $balance = $totalFee - $paid;

        $results = \App\Models\ResultScore::with('subject')
            ->where('student_details_id', $student->id)
            ->where('session', $request->session)
            ->where('status', 'released')
            ->where('term', $request->term)
            ->get();

            if ($results->isEmpty()) {
                return back()->with('error', 'No result found');
            }

            

            $term = $results->first()->term;

            $nextTerm = match($term) {

                    '1st Term'  => '2nd Term',

                    '2nd Term' => '3rd Term',

                    '3rd Term'  => 'Next Session',

                    default       => 'Next Term',
                };

                $annualAverage = null;

                $classStudents = \App\Models\ResultScore::where('session', $request->session)
                ->where('term', $request->term)
                ->whereHas('student', function ($q) use ($student) {
                    $q->where('class_id', $student->class_id);
                })
                ->get()
                ->groupBy('student_details_id');

            $rankings = [];

            foreach ($classStudents as $studentId => $rows) {
                $rankings[$studentId] = round(
                    $rows->avg('total_score'),
                    2
                );
            }

            arsort($rankings);

            $position = array_search($student->id, array_keys($rankings)) + 1;

            $totalInClass = count($rankings);

                if ($term == '3rd Term') {

                    $allTerms = DB::table('result_scores')
                        ->where('student_details_id', $student->id)
                        ->where('session', $request->session)
                        ->get();

                    if ($allTerms->count() > 0) {

                        $grandTotal = $allTerms->sum('total_score');

                        $subjectCount = $allTerms->count();

                        $annualAverage = round(
                            $grandTotal / $subjectCount,
                            2
                        );
                    }
                }

            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Checked result online'
            ]);

        if ($results->isEmpty()) {
            return back()->with('error', 'No result found');
        }

        return view('student.results.show', compact(
                'student', 
                'results', 
                'school',
                'fee',
                'books',
                'paid',
                'totalFee',
                'balance',
                'term',
                'nextTerm',
                'annualAverage',
                'newClass',
                'position',
                'totalInClass',
                'presentDays',
                'lateDays',
                'absentDays',
                'attendanceRate'
            ));
    }

    public function downloadPdf(Request $request)
    {
        $student = StudentDetail::where(
            'registration_number',
            $request->registration_number
        )->first();

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

        $school = \App\Models\School::find($student->school_id);

        $results = ResultScore::with('subject')
            ->where('student_details_id', $student->id)
            ->where('session', $request->session)
            ->where('term', $request->term)
            ->where('status', 'released')
            ->get();

        if ($results->isEmpty()) {
            return back()->with('error', 'No result found');
        }

        $term = $results->first()->term;

        // ✅ TOTAL + AVERAGE
        $grandTotal = $results->sum('total_score');
        $subjectCount = $results->count();
        $average = $subjectCount > 0
            ? round($grandTotal / $subjectCount, 2)
            : 0;

        // 🟢 ATTENDANCE
        $attendanceRows = \App\Models\Attendance::where(
            'student_details_id',
            $student->id
        )->whereMonth('date', now()->month)->get();

        $presentDays = $attendanceRows->count();

        $lateDays = $attendanceRows
            ->where('status', 'late')
            ->count();

        $schoolDays = 60;

        $absentDays = max($schoolDays - $presentDays, 0);

        $attendanceRate = $schoolDays > 0
            ? round(($presentDays / $schoolDays) * 100, 2)
            : 0;

        // 🟢 FEES
        $fee = DB::table('school_fees')
            ->where('school_id', $student->school_id)
            ->where('class_id', $student->class_id)
            ->latest()
            ->first();

        $paid = DB::table('school_fee_payments')
            ->where('student_id', $student->user_id)
            ->where('status', 'confirmed')
            ->sum('amount');

        $totalFee = 0;

        if ($fee) {
            $totalFee =
                ($fee->tuition ?? 0) +
                ($fee->uniforms ?? 0) +
                ($fee->sports_wear ?? 0) +
                ($fee->books ?? 0) +
                ($fee->exam_fee ?? 0) +
                ($fee->pta_levy ?? 0) +
                ($fee->other_fee ?? 0);
        }

        $balance = $totalFee - $paid;

        $pdf = Pdf::loadView(
            'student.results.pdf',
            compact(
                'student',
                'school',
                'results',
                'term',
                'grandTotal',
                'average',

                // ✅ ADD THESE
                'presentDays',
                'lateDays',
                'absentDays',
                'attendanceRate',

                'totalFee',
                'paid',
                'balance'
            )
        );

        return $pdf->download('result.pdf');
    }

}