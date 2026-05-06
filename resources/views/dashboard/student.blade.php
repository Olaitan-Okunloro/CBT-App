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

        <div>

            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#studentProfileModal">
                <i class="fas fa-user-circle me-2"></i>
                View Profile
            </button>

            <span class="badge bg-success px-3 py-2 ms-2">
                Active Session
            </span>

        </div>

    </div>

    <div class="row g-3">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-primary">
                                Available Exams
                            </small>

                            <h2 class="fw-bold mt-2">
                                {{ $availableExams ?? 0 }}
                            </h2>

                        </div>

                        <div class="text-primary">
                            <i class="fas fa-book-open fa-2x"></i>
                        </div>

                    </div>

                    <small class="text-primary">
                        Exams ready to take
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
                                Completed
                            </small>

                            <h2 class="fw-bold mt-2">
                                {{ $completedExams ?? 0 }}
                            </h2>

                        </div>

                        <div class="text-success">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>

                    </div>

                    <small class="text-success">
                        Exams you've taken
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
                                Average Score
                            </small>

                            <h2 class="fw-bold mt-2">
                                {{ isset($avgScore) ? round($avgScore, 2) : 0 }}%
                            </h2>

                        </div>

                        <div class="text-info">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>

                    </div>

                    <div class="progress mt-3" style="height:8px;">

                        <div class="progress-bar"
                             style="width: {{ isset($avgScore) ? $avgScore : 0 }}%">
                        </div>

                    </div>

                    <small class="text-info mt-2 d-block">
                        Your overall performance
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
                        Best Performance
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ isset($bestScore) ? round($bestScore, 2) : 0 }}%
                    </h2>

                    <small class="text-warning">
                        Your highest score
                    </small>

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
                        Your Performance Rating
                    </small>

                    <div class="mt-3">
                        <span class="badge bg-{{ $badgeColor }} px-3 py-2">
                            {{ $performanceLevel }}
                        </span>
                    </div>

                    <small class="text-info d-block mt-3">
                        Based on your exam history
                    </small>

                </div>

            </div>

        </div>

    </div>

    @if(isset($recentExams) && count($recentExams) > 0)

        <div class="card shadow-sm border-0 mt-4">

            <div class="card-header bg-dark text-white">
                <i class="fas fa-history me-2"></i>
                Recent Exam Activities
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>Exam Title</th>
                                <th>Score</th>
                                <th>Grade</th>
                                <th>Date Taken</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($recentExams as $exam)

                                <tr>

                                    <td>
                                        {{ $exam->exam->title ?? 'N/A' }}
                                    </td>

                                    <td>
                                        @php
                                            $percentage = ($exam->score / $exam->total_marks) * 100;
                                        @endphp
                                        <span class="badge bg-{{ $percentage >= 70 ? 'success' : ($percentage >= 50 ? 'warning' : 'danger') }}">
                                            {{ round($percentage, 2) }}%
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $grade = $percentage >= 70 ? 'A' : ($percentage >= 60 ? 'B' : ($percentage >= 50 ? 'C' : ($percentage >= 45 ? 'D' : ($percentage >= 40 ? 'E' : 'F'))));
                                            $gradeColor = $grade == 'A' ? 'success' : ($grade == 'B' ? 'info' : ($grade == 'C' ? 'warning' : 'danger'));
                                        @endphp
                                        <span class="badge bg-{{ $gradeColor }}">
                                            {{ $grade }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $exam->created_at->format('d M Y h:i A') }}
                                    </td>

                                    <td>
                                        <span class="badge bg-success">Completed</span>
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

        @if(isset($availableExams) && $availableExams > 0)

            You have
            <strong>{{ $availableExams }}</strong>
            exam(s) ready to take.

        @else

            No pending exams at the moment.

        @endif

    </div>

</div>

<!-- Student Profile Modal -->
<div class="modal fade" id="studentProfileModal" tabindex="-1" aria-labelledby="studentProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="studentProfileModalLabel">
                    <i class="fas fa-user-circle me-2"></i>
                    Student Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="text-center mb-4">
                    <!-- Profile Picture -->
                    <div class="position-relative d-inline-block">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/profile/' . auth()->user()->profile_photo) }}" 
                                 alt="Profile Picture" 
                                 class="rounded-circle border border-3 border-primary"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user-graduate fa-4x text-white"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        @if(auth()->user()->studentDetail && auth()->user()->studentDetail->has_paid)
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-white">
                                <i class="fas fa-check-circle text-white" style="font-size: 12px;"></i>
                            </span>
                        @else
                            <span class="position-absolute bottom-0 end-0 bg-warning rounded-circle p-2 border border-white">
                                <i class="fas fa-exclamation-circle text-white" style="font-size: 12px;"></i>
                            </span>
                        @endif
                    </div>
                    
                    <h4 class="mt-3 mb-0">{{ auth()->user()->name }}</h4>
                    <small class="text-muted">{{ ucfirst(auth()->user()->role) }}</small>
                </div>
                
                <!-- Profile Information -->
                <div class="alert alert-info border-0 shadow-sm">
                    <h5 class="mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Personal Information
                    </h5>
                    
                    <p class="mb-2">
                        <i class="fas fa-id-card me-2 text-primary"></i>
                        <strong>Registration Number:</strong><br>
                        {{ auth()->user()->studentDetail->registration_number ?? 'N/A' }}
                    </p>
                    
                    <p class="mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <strong>Email:</strong><br>
                        {{ auth()->user()->email }}
                    </p>
                    
                    <p class="mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <strong>Phone:</strong><br>
                        {{ auth()->user()->phone ?? 'N/A' }}
                    </p>
                    
                    <p class="mb-2">
                        <i class="fas fa-graduation-cap me-2 text-primary"></i>
                        <strong>Exam Type:</strong><br>
                        {{ auth()->user()->exam_type ?? 'N/A' }}
                    </p>
                    
                    <p class="mb-2">
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>
                        <strong>Exam Year:</strong><br>
                        {{ auth()->user()->exam_year ?? 'N/A' }}
                    </p>
                    
                    @php
                        $student = auth()->user()->studentDetail;
                    @endphp
                    
                    @if($student)
                        <p class="mb-2">
                            <i class="fas fa-school me-2 text-primary"></i>
                            <strong>School:</strong><br>
                            {{ $student->school->name ?? 'Not Assigned' }}
                        </p>
                        
                        <p class="mb-2">
                            <i class="fas fa-layer-group me-2 text-primary"></i>
                            <strong>Class:</strong><br>
                            {{ $student->class->name ?? 'Not Assigned' }}
                        </p>
                        
                        @if($student->payment_expiry)
                            <p class="mb-0">
                                <i class="fas fa-clock me-2 text-warning"></i>
                                <strong>Subscription Expires:</strong><br>
                                {{ $student->payment_expiry->format('F d, Y') }}
                                <span class="badge bg-{{ $student->payment_expiry->isPast() ? 'danger' : 'success' }} ms-2">
                                    {{ $student->payment_expiry->diffForHumans() }}
                                </span>
                            </p>
                        @else
                            <p class="mb-0 text-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Subscription not active.</strong>
                            </p>
                        @endif
                    @endif
                </div>
                
                <!-- Quick Stats -->
                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <div class="card bg-light border-0 text-center p-2">
                            <small class="text-muted">Exams Taken</small>
                            <h5 class="mb-0">{{ $completedExams ?? 0 }}</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light border-0 text-center p-2">
                            <small class="text-muted">Average Score</small>
                            <h5 class="mb-0">{{ isset($avgScore) ? round($avgScore, 2) : 0 }}%</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <a href="{{ route('student.profile') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .modal-content {
        border-radius: 15px;
        border: none;
        overflow: hidden;
    }
    
    .modal-header {
        border-bottom: none;
    }
    
    .modal-footer {
        border-top: none;
        background-color: #f8f9fa;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #e8f4fd 0%, #f0f7ff 100%);
        border: none;
        border-radius: 12px;
    }
    
    @keyframes fadeInModal {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .modal.fade .modal-dialog {
        animation: fadeInModal 0.3s ease-out;
    }
</style>
@endpush