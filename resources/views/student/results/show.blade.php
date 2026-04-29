@extends('layouts.app')

@section('title', 'Student Result')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/default-logo.png') }}" width="90">
                        <h3 class="mt-2 mb-0">{{ $school->name ?? 'School Name' }}</h3>
                        <p class="mb-1">
                            {{ $school->address ?? '' }}
                        </p>
                        <p class="text-success">Official Result Sheet</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Student:</strong>
                            {{ $student->user->name ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Reg No:</strong>
                            {{ $student->registration_number }}
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <strong>Position:</strong>
                            {{ $position }}
                        </div>

                        <div class="col-md-4">
                            <strong>Class Size:</strong>
                            {{ $totalInClass }}
                        </div>

                        <div class="col-md-4">
                            <strong>Session:</strong>
                            {{ request('session') }}
                        </div>

                    </div>

                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Term</th>
                                <th>Subject</th>
                                <th>Test</th>
                                <th>Exam</th>
                                <th>Total</th>
                                <th>Grade</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0;
                            $count = 0;
                            @endphp

                            @foreach($results as $row)
                                @php
                                $total += $row->total_score;
                                $count++;
                                @endphp
                                <tr>
                                    <td>{{ $row->term }}</td>
                                    <td>{{ $row->subject->name ?? 'N/A' }}</td>
                                    <td>{{ $row->test_score }}</td>
                                    <td>{{ $row->exam_score }}</td>
                                    <td>{{ $row->total_score }}</td>
                                    <td>{{ $row->grade }}</td>
                                    <td>{{ $row->remark }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @php
                    $average = $count > 0 ? round($total / $count,2) : 0;
                    @endphp

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Total Score:</strong> {{ $total }}
                        </div>
                        <div class="col-md-6">
                            <strong>Average:</strong> {{ $average }}
                        </div>
                    </div>



                    @if($term == '3rd Term')

                    <div class="card mt-4 shadow-sm border-0">

                        <div class="card-header bg-dark text-white text-align-center">
                            Annual Performance Summary
                        </div>

                        <div class="card-body text-center">

                            <h4>
                                Annual Average Score:
                                {{ $annualAverage }}
                            </h4>

                            <h5 class="mt-3">

                                @if($annualAverage >= 50)

                                    <span class="text-success">
                                        You Have Been Promoted to: {{ $newClass }}
                                    </span>

                                @else

                                    <span class="text-danger">
                                        Sorry, You Have to Repeat Current Class
                                    </span>

                                @endif

                            </h5>

                        </div>

                    </div>

                    @endif

                    <div class="card mt-4 shadow-sm border-0">

                            <div class="card-header bg-info text-white">
                                Attendance Summary
                            </div>

                            <div class="card-body">

                                <div class="row text-center">

                                    <div class="col-md-3">
                                        <strong>Present</strong><br>
                                        {{ $presentDays }}
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Absent</strong><br>
                                        {{ $absentDays }}
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Late</strong><br>
                                        {{ $lateDays }}
                                    </div>

                                    <div class="col-md-3">
                                        <strong>Rate</strong><br>
                                        {{ $attendanceRate }}%
                                    </div>

                                </div>

                            </div>

                        </div>


                    <div class="row mt-4">

                        <div class="col-md-6">

                            <div class="card shadow-sm">

                                <div class="card-header bg-success text-white">
                                    {{ $term }} Fees Summary
                                </div>

                                <div class="card-body">

                                    <p>Total Fees:
                                        ₦{{ number_format($totalFee,2) }}
                                    </p>

                                    <p>Paid:
                                        ₦{{ number_format($paid,2) }}
                                    </p>

                                    <p>Balance:
                                        ₦{{ number_format($balance,2) }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                Requirements For {{ $nextTerm }}
                            </div>

                            <div class="card-body">

                                <p>
                                    School Fees:
                                    ₦{{ number_format($fee->tuition ?? 0, 2) }}
                                </p>

                                <p>
                                    Books:
                                    ₦{{ number_format($fee->books ?? 0, 2) }}
                                </p>

                                <p>
                                    Uniform:
                                    ₦{{ number_format($fee->uniforms ?? 0, 2) }}
                                </p>

                                <p>
                                    {{ $books->materials ?? 'No materials listed' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="row mt-5 text-center">

                    <div class="col-md-4">

                        @if(isset($teacher) && $teacher->signature)

                            <img src="{{ asset('storage/signatures/' . $teacher->signature) }}"
                                height="70">

                        @endif

                        <hr>

                        <p class="mb-0 fw-bold">
                            Class Teacher
                        </p>

                    </div>

                    <div class="col-md-4">

                        @if(isset($school) && $school->principal_signature)

                            <img src="{{ asset('storage/signatures/' . $school->principal_signature) }}"
                                height="70">

                        @endif

                        <hr>

                        <p class="mb-0 fw-bold">
                            Principal
                        </p>

                    </div>

                    <div class="col-md-4">

                        @if(isset($school) && $school->stamp_logo)

                            <img src="{{ asset('storage/stamps/' . $school->stamp_logo) }}"
                                height="80">

                        @endif

                        <hr>

                        <p class="mb-0 fw-bold">
                            Official Stamp
                        </p>

                    </div>

                </div>

                    <div class="row mt-4">

                        <div class="col-md-12 text-center">

                            <small class="text-muted">
                                Date Issued:
                                {{ now()->format('d M Y') }}
                            </small>

                        </div>

                    </div>

                    <div class="mt-4 d-print-none">
                        <button onclick="window.print()" class="btn btn-success">
                            <i class="fas fa-print me-2"></i>
                            Print Result
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection