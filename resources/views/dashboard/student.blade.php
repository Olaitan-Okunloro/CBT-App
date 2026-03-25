<!-- resources/views/dashboard/student.blade.php -->
@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0" style="color:white"><i class="fas fa-school me-2" style="color:white"></i>Student Dashboard</h4>
            </div>

            <div class="card-body">
                <!-- Welcome Section -->
                <div class="alert alert-info mt-3">
                    <h5>Welcome, {{ auth()->user()->name }}!</h5>
                    <p>Registration Number: {{ auth()->user()->studentDetail->registration_number ?? 'N/A' }}</p>
                    <p class="mb-0">Email: {{ auth()->user()->email }}</p>
                    <br>
                    @php
                        $student = auth()->user()->studentDetail;
                    @endphp

                    @if($student && $student->payment_expiry)
                        <p>
                            Your subscription expires in: 
                            {{ $student->payment_expiry->diffForHumans() }}
                        </p>
                    @else
                        <p class="text-warning">
                            Subscription not active.
                        </p>
                    @endif
                </div>

                <!-- Statistics Cards Row -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Available Exams</h5>
                                <p class="card-text display-4">{{ $availableExams ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Completed Exams</h5>
                                <p class="card-text display-4">{{ $completedExams ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">Average Score</h5>
                                <p class="card-text display-4">{{ round($averageScore ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Statistics Row -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Highest Score</h5>
                                <p class="card-text display-4">{{ $highestScore ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="card bg-secondary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Exams Taken</h5>
                                <p class="card-text display-4">{{ $totalExams ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subject Performance Section -->
                @if(isset($subjectStats) && count($subjectStats) > 0)
                    <hr>
                    <h5 class="mb-3">Subject Performance</h5>
                    
                    <div class="row mb-4">
                        @foreach($subjectStats as $subject => $records)
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title text-muted mb-2">{{ $subject }}</h6>
                                        <h3 class="mb-0 {{ round($records->avg('score'), 2) >= 70 ? 'text-success' : (round($records->avg('score'), 2) >= 50 ? 'text-warning' : 'text-danger') }}">
                                            {{ round($records->avg('score'), 2) }}%
                                        </h3>
                                        <small class="text-muted">Average Score</small>
                                        <div class="mt-2">
                                            <span class="badge bg-secondary">{{ $records->count() }} exam(s)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Exam History Section -->
                @if(isset($attempts) && count($attempts) > 0)
                    <hr>
                    <h5 class="mb-3">Exam History</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Exam</th>
                                    <th>Subject</th>
                                    <th>Score</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attempts as $attempt)
                                <tr>
                                    <td>{{ $attempt->exam->title ?? 'N/A' }}</td>
                                    <td>{{ $attempt->exam->subject ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $attempt->score >= 70 ? 'success' : ($attempt->score >= 50 ? 'warning' : 'danger') }}">
                                            {{ $attempt->score }}%
                                        </span>
                                    </td>
                                    <td>{{ $attempt->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-secondary mt-4">
                        <i class="fas fa-info-circle me-2"></i> No exam attempts yet. Start taking exams to see your history here!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection