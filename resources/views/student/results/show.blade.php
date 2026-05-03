@extends('layouts.app')

@section('title', 'Result Sheet')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4 bg-white text-dark">
        {{-- SCHOOL --}}
        <div class="text-center mb-3">
            <h3>{{ $school->name ?? 'School Name' }}</h3>
            <p>{{ $school->address ?? '' }}</p>
            <h5>Student Result Sheet</h5>
        </div>

        <hr>

        {{-- STUDENT INFO --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Name:</strong> {{ $student->user->name ?? '' }}
            </div>

            <div class="col-md-6 text-end">
                <strong>Reg No:</strong> {{ $student->registration_number }}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <strong>Class:</strong> {{ $student->class->name ?? '' }}
            </div>

            <div class="col-md-6 text-end">
                <strong>Term:</strong> {{ $term }}
            </div>
        </div>

        <hr>

        {{-- RESULT TABLE --}}
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>1st CA</th>
                    <th>2nd CA</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Grade</th>
                    <th>Remark</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $grandTotal = 0;
                @endphp

                @foreach($results as $row)
                    @php
                        $grandTotal += $row->total_score;
                    @endphp

                    <tr>
                        <td>{{ $row->subject->name }}</td>
                        <td>{{ $row->first_ca_score }}</td>
                        <td>{{ $row->second_ca_score }}</td>
                        <td>{{ $row->exam_score }}</td>
                        <td><strong>{{ $row->total_score }}</strong></td>
                        <td>{{ $row->grade }}</td>
                        <td>{{ $row->remark }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- SUMMARY --}}
        @php
            $subjectCount = count($results);
            $average = $subjectCount > 0 ? round($grandTotal / $subjectCount, 2) : 0;
        @endphp

        <div class="row mt-3">
            <div class="col-md-4">
                <strong>Total Score:</strong> {{ $grandTotal }}
            </div>

            <div class="col-md-4">
                <strong>Average:</strong> {{ $average }}
            </div>

            <div class="col-md-4 text-end">
                <strong>Position:</strong> {{ $position }} / {{ $totalInClass }}
            </div>
        </div>

        <hr>

        {{-- ATTENDANCE --}}
        <div class="row mt-3">
            <div class="col-md-4">
                Present: {{ $presentDays }}
            </div>

            <div class="col-md-4">
                Late: {{ $lateDays }}
            </div>

            <div class="col-md-4">
                Absent: {{ $absentDays }}
            </div>
        </div>

        <div class="mt-2">
            <strong>Attendance Rate:</strong> {{ $attendanceRate }}%
        </div>

        <hr>

        {{-- FEES --}}
        <div class="row mt-3">
            <div class="col-md-4">
                Total Fee: {{ number_format($totalFee) }}
            </div>

            <div class="col-md-4">
                Paid: {{ number_format($paid) }}
            </div>

            <div class="col-md-4 text-danger">
                Balance: {{ number_format($balance) }}
            </div>
        </div>

        <hr>

        {{-- PROMOTION --}}
        <div class="mt-3">
            <strong>Next Term:</strong> {{ $nextTerm }} <br>
            <strong>Next Class:</strong> {{ $newClass }}
        </div>

        <hr>

        {{-- SIGNATURE --}}
        <div class="row mt-5">
            <div class="col-md-6">
                _____________________<br>
                Class Teacher
            </div>

            <div class="col-md-6 text-end">
                _____________________<br>
                Principal
            </div>
        </div>
    </div>
</div><br>
<a href="{{ route('student.result.pdf', [
    'registration_number' => $student->registration_number,
    'session' => request('session'),
    'term' => request('term')
]) }}"
class="btn btn-success">

Download PDF

</a>

@endsection