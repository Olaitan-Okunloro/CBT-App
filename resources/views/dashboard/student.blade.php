@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container">

    @if($announcements->count())

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">

                <div>
                    <i class="fas fa-bullhorn me-2"></i>
                    Announcements
                </div>

                <small>
                    Latest Updates
                </small>

            </div>

            <div class="card-body">

                @foreach($announcements as $row)

                    <div class="border-bottom mb-3 pb-3">

                        <h6 class="fw-bold mb-1">
                            {{ $row->title }}
                        </h6>

                        <p class="mb-1 text-muted">
                            {{ $row->message }}
                        </p>

                        <small class="text-secondary">
                            {{ $row->created_at->diffForHumans() }}
                        </small>

                    </div>

                @endforeach

            </div>

        </div>

    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1 text-white">
                <i class="fas fa-user-graduate me-2"></i>
                Student Dashboard
            </h3>

            <small class="text-light">
                Welcome back, {{ auth()->user()->name }}
            </small>

        </div>

        <span class="badge bg-success px-3 py-2">
            Active Student
        </span>

    </div>

    <div class="alert alert-info border-0 shadow-sm">

        <h5 class="mb-2">
            Welcome, {{ auth()->user()->name }}!
        </h5>

        <p class="mb-1">
            Registration Number:
            <strong>{{ auth()->user()->studentDetail->registration_number ?? 'N/A' }}</strong>
        </p>

        <p class="mb-1">
            Email:
            <strong>{{ auth()->user()->email }}</strong>
        </p>

        @php
            $student = auth()->user()->studentDetail;
        @endphp

        @if($student && $student->payment_expiry)

            <p class="mb-0">
                Subscription expires
                <strong>{{ $student->payment_expiry->diffForHumans() }}</strong>
            </p>

        @else

            <p class="mb-0 text-warning">
                Subscription not active.
            </p>

        @endif

    </div>

    <div class="row g-3 mt-1">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Available Exams
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ $availableExams ?? 0 }}
                    </h2>

                    <small class="text-muted">
                        Ready to take
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Completed Exams
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ $completedExams ?? 0 }}
                    </h2>

                    <small class="text-muted">
                        Exams submitted
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Average Score
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ round($averageScore ?? 0, 2) }}%
                    </h2>

                    <small class="text-muted">
                        Overall performance
                    </small>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-3 mt-1">

        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Highest Score
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ $highestScore ?? 0 }}%
                    </h2>

                    <small class="text-muted">
                        Best result achieved
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Exams Taken
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ $totalExams ?? 0 }}
                    </h2>

                    <small class="text-muted">
                        Exams attempted
                    </small>

                </div>

            </div>

        </div>

    </div>

    @if(isset($subjectStats) && count($subjectStats) > 0)

        <div class="card border-0 shadow-sm mt-4">

            <div class="card-header bg-primary text-white">
                Subject Performance
            </div>

            <div class="card-body">

                <div class="row g-3">

                    @foreach($subjectStats as $subject => $records)

                        <div class="col-md-3 col-sm-6">

                            <div class="card border-0 bg-light h-100">

                                <div class="card-body text-center">

                                    <h6 class="text-muted mb-2">
                                        {{ $subject }}
                                    </h6>

                                    <h3 class="{{ round($records->avg('score'), 2) >= 70 ? 'text-success' : (round($records->avg('score'), 2) >= 50 ? 'text-warning' : 'text-danger') }}">

                                        {{ round($records->avg('score'), 2) }}%

                                    </h3>

                                    <small class="text-muted">
                                        Average Score
                                    </small>

                                    <div class="mt-2">

                                        <span class="badge bg-secondary">
                                            {{ $records->count() }} exam(s)
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endif

    @if(isset($attempts) && count($attempts) > 0)

        <div class="card shadow-sm border-0 mt-4">

            <div class="card-header bg-dark text-white">
                Exam History
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>Exam</th>
                                <th>Score</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($attempts as $attempt)

                                <tr>

                                    <td>
                                        {{ $attempt->exam->title ?? 'N/A' }}
                                    </td>

                                    <td>

                                        <span class="badge bg-{{ $attempt->score >= 70 ? 'success' : ($attempt->score >= 50 ? 'warning' : 'danger') }}">
                                            {{ $attempt->score }}%
                                        </span>

                                    </td>

                                    <td>
                                        {{ $attempt->created_at->format('d M Y h:i A') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @else

        <div class="alert alert-secondary mt-4 border-0 shadow-sm">

            <i class="fas fa-info-circle me-2"></i>

            No exam attempts yet.
            Start taking exams to see your history here.

        </div>

    @endif

</div>
@endsection