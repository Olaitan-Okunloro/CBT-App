<!-- resources/views/school/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'School Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Header with Stats -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color:white"><i class="fas fa-school me-2" style="color:white"></i>School Dashboard</h2>
        <div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-chart-bar me-1"></i>Generate Report
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-left-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="text-xs text-success text-uppercase mb-1">Total Teachers</div>
                            <div class="h3 mb-0 font-weight-bold">{{ $teachers ?? 0 }}</div>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-chalkboard-teacher fa-3x text-primary opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-left-success">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="text-xs text-success text-uppercase mb-1">Total Students</div>
                            <div class="h3 mb-0 font-weight-bold">{{ $students ?? 0 }}</div>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-user-graduate fa-3x text-success opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-left-info">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="text-xs text-success text-uppercase mb-1">Total Classes</div>
                            <div class="h3 mb-0 font-weight-bold">{{ $classes ?? 0 }}</div>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-layer-group fa-3x text-info opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-left-warning">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="text-xs text-success text-uppercase mb-1">Active Users</div>
                            <div class="h3 mb-0 font-weight-bold">{{ $activeUsers ?? 0 }}</div>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-clock fa-3x text-warning opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Recent Teachers</h5>
                    <a href="{{ route('school.teachers') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($recentTeachers) && $recentTeachers->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentTeachers as $teacher)
                                <div class="list-group-item px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-circle bg-primary-soft text-primary">
                                                {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $teacher->user->name }}</h6>
                                            <small class="text-muted">{{ $teacher->user->email }}</small>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <small class="text-muted">{{ $teacher->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No teachers added yet.</p>
                            <a href="{{ route('school.teacher.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i>Add Teacher
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-graduate me-2 text-success"></i>Recent Students</h5>
                    <a href="{{ route('school.students') }}" class="btn btn-sm btn-success">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($recentStudents) && $recentStudents->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentStudents as $student)
                                <div class="list-group-item px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-circle bg-success-soft text-success">
                                                {{ strtoupper(substr($student->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $student->user->name }}</h6>
                                            <small class="text-muted">
                                                {{ $student->class->name ?? 'No Class' }} | Reg: {{ $student->registration_number }}
                                            </small>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <small class="text-muted">{{ $student->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No students added yet.</p>
                            <a href="{{ route('school.student.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus me-1"></i>Add Student
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Alert -->
    <div class="alert alert-success mt-4 d-flex align-items-center">
        <i class="fas fa-school fa-2x me-3"></i>
        <div>
            <strong>Welcome, {{ auth()->user()->name }}!</strong><br>
            <small class="text-muted">You're logged into your school dashboard. Use the navigation menu above to manage your school.</small>
        </div>
    </div>
</div>

@push('styles')
<style>
    .stat-card {
        border: none;
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 4px solid;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .border-left-primary {
        border-left-color: #6f42c1;
    }
    .border-left-success {
        border-left-color: #28a745;
    }
    .border-left-info {
        border-left-color: #17a2b8;
    }
    .border-left-warning {
        border-left-color: #ffc107;
    }
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.2rem;
    }
    .bg-primary-soft {
        background: rgba(111, 66, 193, 0.1);
    }
    .bg-success-soft {
        background: rgba(40, 167, 69, 0.1);
    }
    .opacity-25 {
        opacity: 0.25;
    }
</style>
@endpush

@push('scripts')
<script>
    // Optional: Add any dashboard-specific JavaScript here
</script>
@endpush

@endsection