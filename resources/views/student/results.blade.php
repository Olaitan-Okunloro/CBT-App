<!-- resources/views/student/results.blade.php -->
@extends('layouts.app')

@section('title', 'My Results')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>My Results</h4>
                </div>
                <div class="card-body">
                    @if($results->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Exam</th>
                                        <th>Date Taken</th>
                                        <th>Score</th>
                                        <th>Percentage</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $attempt)
                                        <tr>
                                            <td>{{ $attempt->exam->title }}</td>
                                            <td>{{ $attempt->end_time->format('M d, Y') }}</td>
                                            <td>{{ $attempt->score }}/{{ $attempt->exam->total_marks }}</td>
                                            <td>{{ number_format($attempt->percentage, 2) }}%</td>
                                            <td>
                                                @php
                                                    $grade = $attempt->percentage >= 70 ? 'A' : 
                                                            ($attempt->percentage >= 60 ? 'B' : 
                                                            ($attempt->percentage >= 50 ? 'C' : 
                                                            ($attempt->percentage >= 45 ? 'D' : 
                                                            ($attempt->percentage >= 40 ? 'E' : 'F'))));
                                                @endphp
                                                <span class="badge bg-{{ $grade == 'F' ? 'danger' : ($grade == 'A' ? 'success' : 'info') }}">
                                                    {{ $grade }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($attempt->percentage >= $attempt->exam->passing_marks)
                                                    <span class="badge bg-success">Passed</span>
                                                @else
                                                    <span class="badge bg-danger">Failed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                            <h5>No Results Yet</h5>
                            <p class="text-muted">You haven't taken any exams yet.</p>
                            <a href="{{ route('student.exams.available') }}" class="btn btn-primary">
                                <i class="fas fa-book-open me-2"></i>View Available Exams
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection