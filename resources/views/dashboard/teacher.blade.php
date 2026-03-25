@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4" style="color:white"><i class="fas fa-school me-2" style="color:white"></i>Teacher Dashboard</h3>
    
    <div class="row">
        <!-- Questions Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">My Questions</h5>
                    <h2 class="display-4">{{ $questionsCount ?? 0 }}</h2>
                    <p class="mb-0">Total questions in your bank</p>
                </div>
            </div>
        </div>

        <!-- Students Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>
                    <h2 class="display-4">{{ $studentsCount ?? 0 }}</h2>
                    <p class="mb-0">Students in your class</p>
                </div>
            </div>
        </div>

        <!-- Total Attempts Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Exam Attempts</h5>
                    <h2 class="display-4">{{ $totalAttempts ?? 0 }}</h2>
                    <p class="mb-0">Total exams taken</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row - Performance Metrics -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Average Score</h5>
                    <h2 class="display-4">{{ isset($avgScore) ? round($avgScore, 2) : 0 }}%</h2>
                    <p class="mb-0">Class average score</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Class Performance</h5>
                    @php
                        $performanceLevel = isset($avgScore) ? 
                            ($avgScore >= 70 ? 'Excellent' : ($avgScore >= 50 ? 'Good' : 'Needs Improvement')) : 'N/A';
                        $badgeColor = isset($avgScore) ? 
                            ($avgScore >= 70 ? 'success' : ($avgScore >= 50 ? 'warning' : 'danger')) : 'secondary';
                    @endphp
                    <h3><span class="badge bg-{{ $badgeColor }}">{{ $performanceLevel }}</span></h3>
                    <p class="mb-0">Overall class rating</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    @if(isset($recentAttempts) && count($recentAttempts) > 0)
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Student Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Exam Title</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentAttempts as $attempt)
                                    <tr>
                                        <td>{{ $attempt->user->name ?? 'N/A' }}</td>
                                        <td>{{ $attempt->exam->title ?? 'N/A' }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="alert alert-success mt-4">
        <i class="fas fa-chalkboard-teacher me-2"></i>
        Welcome back Teacher <strong>{{ auth()->user()->name }}</strong>! 
        @if(isset($studentsCount) && $studentsCount > 0)
            You have {{ $studentsCount }} student(s) in your class.
        @else
            No students assigned to your class yet.
        @endif
    </div>
</div>
@endsection