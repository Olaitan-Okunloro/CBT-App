@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">
                <i class="fas fa-user-graduate me-2"></i>
                Student Dashboard
            </h3>
            <small>
                Welcome back, {{ auth()->user()->name }}
            </small>
        </div>

        <div>
            <button type="button" class="btn text-success btn-outline-light" data-bs-toggle="modal" data-bs-target="#studentProfileModal">
                <i class="fas fa-user-circle me-2"></i>
                View Profile
            </button>
            <span class="badge bg-success px-3 py-2 ms-2">
                Active Session
            </span>
        </div>

    </div>

    <!-- Stats Cards Row -->
    <div class="row g-3">

        <!-- Total Exams Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-primary">Total Exams Taken</small>
                            <h2 class="fw-bold mt-2">{{ $totalExams ?? 0 }}</h2>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                    </div>
                    <small class="text-primary">Exams you've completed</small>
                </div>
            </div>
        </div>

        <!-- Average Score Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-info">Average Score</small>
                            <h2 class="fw-bold mt-2">{{ isset($averageScore) ? round($averageScore, 2) : 0 }}%</h2>
                        </div>
                        <div class="text-info">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: {{ isset($averageScore) ? $averageScore : 0 }}%"></div>
                    </div>
                    <small class="text-info mt-2 d-block">Your overall performance</small>
                </div>
            </div>
        </div>

        <!-- Highest Score Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-success">Best Performance</small>
                            <h2 class="fw-bold mt-2">{{ isset($highestScore) ? round($highestScore, 2) : 0 }}%</h2>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-trophy fa-2x"></i>
                        </div>
                    </div>
                    <small class="text-success">Your highest score</small>
                </div>
            </div>
        </div>

    </div>

    <!-- Performance Rating Row -->
    <div class="row g-3 mt-1">

        <!-- Performance Level -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-warning">Your Performance Level</small>
                    <div class="mt-3">
                        @php
                            $avgScore = $averageScore ?? 0;
                            $performanceLevel = $avgScore >= 70 ? 'Excellent' : ($avgScore >= 50 ? 'Good' : ($avgScore >= 40 ? 'Average' : 'Needs Improvement'));
                            $badgeColor = $avgScore >= 70 ? 'success' : ($avgScore >= 50 ? 'warning' : ($avgScore >= 40 ? 'info' : 'danger'));
                        @endphp
                        <span class="badge bg-{{ $badgeColor }} px-3 py-2 fs-6">
                            {{ $performanceLevel }}
                        </span>
                    </div>
                    <small class="text-warning d-block mt-3">Based on your exam history</small>
                </div>
            </div>
        </div>

        <!-- Subject Performance Summary -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-primary">Subjects Performance</small>
                    <div class="mt-2">
                        @if(isset($subjectStats) && $subjectStats->count() > 0)
                            @foreach($subjectStats as $subjectName => $subjectAttempts)
                                @php
                                    $subjectAvg = $subjectAttempts->avg('score');
                                    $subjectColor = $subjectAvg >= 70 ? 'success' : ($subjectAvg >= 50 ? 'warning' : 'danger');
                                @endphp
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between small">
                                        <span>{{ $subjectName }}</span>
                                        <span>{{ round($subjectAvg, 1) }}%</span>
                                    </div>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-{{ $subjectColor }}" style="width: {{ $subjectAvg }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted small">No subject data available yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Exam Activities Table -->
    @if(isset($attempts) && $attempts->count() > 0)
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header  d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-history me-2"></i>
                Recent Exam Activities
            </div>
            <div>
                <span class="badge bg-light text-dark">Total: {{ $attempts->total() }} exams</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Exam Title</th>
                            <th>Score</th>
                            <th>Grade</th>
                            <th>Date Taken</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attempts as $exam)
                            @php
                                // SAFE CALCULATION - Prevent division by zero
                                $percentage = ($exam->total_marks > 0) ? ($exam->score / $exam->total_marks) * 100 : 0;
                                $badgeColor = $percentage >= 70 ? 'success' : ($percentage >= 50 ? 'warning' : 'danger');
                                
                                // Grade calculation
                                $grade = $percentage >= 70 ? 'A' : ($percentage >= 60 ? 'B' : ($percentage >= 50 ? 'C' : ($percentage >= 45 ? 'D' : ($percentage >= 40 ? 'E' : 'F'))));
                                $gradeColor = $grade == 'A' ? 'success' : ($grade == 'B' ? 'info' : ($grade == 'C' ? 'warning' : 'danger'));
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $exam->exam->title ?? 'N/A' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $exam->exam->subject->name ?? '' }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $badgeColor }} px-3 py-2">
                                        {{ round($percentage, 1) }}%
                                    </span>
                                    <br>
                                    <small>{{ $exam->score }} / {{ $exam->total_marks }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $gradeColor }} px-3 py-2">
                                        {{ $grade }}
                                    </span>
                                </td>
                                <td>
                                    {{ $exam->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td>
                                    <span class="badge bg-success">Completed</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Links -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing {{ $attempts->firstItem() }} to {{ $attempts->lastItem() }} 
                    of {{ $attempts->total() }} results
                </div>
                <div>
                    {{ $attempts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body text-center py-5">
            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
            <h5>No Exams Taken Yet</h5>
            <p class="text-muted">You haven't completed any exams. Start practicing to see your results here!</p>
            <a href="{{ route('student.exams.available') }}" class="btn btn-primary">
                <i class="fas fa-book-open me-2"></i>Browse Available Exams
            </a>
        </div>
    </div>
    @endif

    <!-- Welcome Alert -->
    <div class="alert alert-success mt-4 border-0 shadow-sm">
        <i class="fas fa-circle-check me-2"></i>
        Welcome back, <strong>{{ auth()->user()->name }}</strong>.
        @if(isset($totalExams) && $totalExams > 0)
            You have completed <strong>{{ $totalExams }}</strong> exam(s) with an average score of <strong>{{ isset($averageScore) ? round($averageScore, 1) : 0 }}%</strong>.
            Keep up the great work!
        @else
            You haven't taken any exams yet. Start practicing to track your progress!
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
                {{-- PROFILE IMAGE SECTION --}}
                <div class="text-center mb-4 text-white">
                    <div class="position-relative d-inline-block">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/profile/' . auth()->user()->profile_photo) }}"
                                 alt="Profile Picture"
                                 class="rounded-circle border border-3 border-primary"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user-graduate fa-4x"></i>
                            </div>
                        @endif

                        {{-- PAYMENT STATUS BADGE --}}
                        @if(auth()->user()->studentDetail && auth()->user()->studentDetail->has_paid)
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-white">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        @else
                            <span class="position-absolute bottom-0 end-0 bg-warning rounded-circle p-2 border border-white">
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                        @endif
                    </div>

                    <h4 class="mt-3 mb-0">{{ auth()->user()->name }}</h4>
                    <small class="text-muted">{{ ucfirst(auth()->user()->role) }}</small>
                </div>

                {{-- PERSONAL INFORMATION SECTION --}}
                <div class="alert alert-info border-0 shadow-sm">
                    <h5 class="mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Personal Information
                    </h5>

                    {{-- REGISTRATION NUMBER --}}
                    <p class="mb-2">
                        <i class="fas fa-id-card me-2 text-primary"></i>
                        <strong>Registration Number:</strong><br>
                        {{ auth()->user()->studentDetail->registration_number ?? 'N/A' }}
                    </p>

                    {{-- EMAIL --}}
                    <p class="mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <strong>Email:</strong><br>
                        {{ auth()->user()->email }}
                    </p>

                    {{-- PHONE --}}
                    <p class="mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <strong>Phone:</strong><br>
                        {{ auth()->user()->phone ?? 'N/A' }}
                    </p>

                    @php $student = auth()->user()->studentDetail; @endphp

                    @if($student)
                        {{-- SCHOOL --}}
                        <p class="mb-2">
                            <i class="fas fa-school me-2 text-primary"></i>
                            <strong>School:</strong><br>
                            {{ $student->school->name ?? 'Not Assigned' }}
                        </p>

                        {{-- CLASS --}}
                        <p class="mb-2">
                            <i class="fas fa-layer-group me-2 text-primary"></i>
                            <strong>Class:</strong><br>
                            {{ $student->class->name ?? 'Not Assigned' }}
                        </p>

                        {{-- SUBSCRIPTION EXPIRY --}}
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

                {{-- STATISTICS CARDS --}}
                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <div class="card bg-light border-0 text-center p-2">
                            <small class="text-muted">Exams Taken</small>
                            <h5 class="mb-0 text-dark">{{ $totalExams ?? 0 }}</h5>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card bg-light border-0 text-center p-2">
                            <small class="text-muted">Average Score</small>
                            <h5 class="mb-0 text-dark">{{ isset($averageScore) ? round($averageScore, 1) : 0 }}%</h5>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL FOOTER --}}
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
    /* Existing styles... */
    
    /* Pagination Styling */
    .pagination {
        margin-bottom: 0;
    }
    
    .pagination .page-item .page-link {
        color: #6f42c1;
        border-radius: 8px;
        margin: 0 3px;
        padding: 8px 14px;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6f42c1 0%, #8a5cf6 100%);
        border-color: #6f42c1;
        color: white;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #adb5bd;
        background-color: #f8f9fa;
    }
    
    .pagination .page-item .page-link:hover:not(.active) {
        background-color: #f0eaff;
        color: #6f42c1;
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
</style>
@endpush