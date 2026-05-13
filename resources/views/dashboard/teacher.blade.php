@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="container">

        {{-- 
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-danger">
            <i class="fas fa-bullhorn me-2"></i>
            Announcements
        </div>
        <div class="card-body">
            @foreach($announcements as $row)
                <div class="border-bottom mb-3 pb-2">
                    <h6 class="mb-1">{{ $row->title }}</h6>
                    <p class="mb-1">{{ $row->message }}</p>
                    <small>{{ $row->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    </div>
    --}}

    <!-- The modal will now popup automatically -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                <i class="fas fa-chalkboard-teacher me-2"></i>
                Teacher Dashboard
            </h3>

            <small>
                Welcome back, {{ auth()->user()->name }}
            </small>

        </div>

        <span class="badge bg-success px-3 py-2">
            Active Session
        </span>

    </div>

    <div class="row g-3">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-primary">
                                My Questions
                            </small>

                            <h2 class="fw-bold mt-2">
                                {{ $questionsCount ?? 0 }}
                            </h2>

                        </div>

                        <div class="text-primary">
                            <i class="fas fa-question-circle fa-2x"></i>
                        </div>

                    </div>

                    <small class="text-primary">
                        Total questions in your bank
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-success">
                                Students
                            </small>

                            <h2 class="fw-bold mt-2">
                                {{ $studentsCount ?? 0 }}
                            </h2>

                        </div>

                        <div class="text-success">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>

                    </div>

                    <small class="text-success">
                        Students in your class
                    </small>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-info">
                                Exam Attempts
                            </small>

                            <h2 class="fw-bold mt-2">
                                {{ $totalAttempts ?? 0 }}
                            </h2>

                        </div>

                        <div class="text-info">
                            <i class="fas fa-file-signature fa-2x"></i>
                        </div>

                    </div>

                    <small class="text-info">
                        Total exams taken
                    </small>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-3 mt-1">

        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-warning">
                        Average Score
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ isset($avgScore) ? round($avgScore, 2) : 0 }}%
                    </h2>

                    <div class="progress mt-3" style="height:8px;">

                        <div class="progress-bar"
                             style="width: {{ isset($avgScore) ? $avgScore : 0 }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            @php
                $performanceLevel = isset($avgScore)
                    ? ($avgScore >= 70
                        ? 'Excellent'
                        : ($avgScore >= 50
                            ? 'Good'
                            : 'Needs Improvement'))
                    : 'N/A';

                $badgeColor = isset($avgScore)
                    ? ($avgScore >= 70
                        ? 'success'
                        : ($avgScore >= 50
                            ? 'warning'
                            : 'danger'))
                    : 'secondary';
            @endphp

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-info">
                        Class Performance
                    </small>

                    <div class="mt-3">
                        <span class="badge bg-{{ $badgeColor }} px-3 py-2">
                            {{ $performanceLevel }}
                        </span>
                    </div>

                    <small class="text-info d-block mt-3">
                        Overall class rating
                    </small>

                </div>

            </div>

        </div>

    </div>

    @if(isset($recentAttempts) && count($recentAttempts) > 0)

        <div class="card shadow-sm border-0 mt-4">

            <div class="card-header">
                <i class="fas fa-history me-2"></i>
                Recent Student Activity
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
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

                                    <td>
                                        {{ $attempt->user->name ?? 'N/A' }}
                                    </td>

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

    @endif

    <div class="alert alert-success mt-4 border-0 shadow-sm">

        <i class="fas fa-circle-check me-2"></i>

        Welcome back
        <strong>{{ auth()->user()->name }}</strong>.

        @if(isset($studentsCount) && $studentsCount > 0)

            You currently manage
            <strong>{{ $studentsCount }}</strong>
            student(s).

        @else

            No students assigned yet.

        @endif

    </div>

</div>
@endsection