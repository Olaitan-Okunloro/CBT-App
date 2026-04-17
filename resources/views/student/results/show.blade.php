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
                        <h3 class="mt-2 mb-0">School Name</h3>
                        <p class="text-muted">Official Result Sheet</p>
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

                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
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