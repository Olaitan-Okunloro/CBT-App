<!-- resources/views/student/available-exams.blade.php -->
@extends('layouts.app')

@section('title', 'Available Exams')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h4 class="mb-0"><i class="fas fa-book-open me-2"></i>Available Exams</h4>
                </div>
                <div class="card-body">
                    @if($exams->count() > 0)
                        <div class="row">
                            @foreach($exams as $exam)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exam->title }}</h5>
                                            <p class="card-text text-muted">
                                                <i class="fas fa-book me-2"></i>{{ $exam->subject->name ?? 'General' }}
                                            </p>
                                            <div class="mb-3">
                                                <span class="badge bg-info me-2">
                                                    <i class="fas fa-clock me-1"></i>{{ $exam->duration }} mins
                                                </span>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-star me-1"></i>{{ $exam->total_marks }} marks
                                                </span>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    Available until: {{ $exam->end_date->format('M d, Y') }}
                                                </small>
                                            </p>
                                            @foreach($exams as $exam)
                                                <a href="{{ route('student.exam.start', $exam->id) }}" class="btn btn-primary">
                                                    Start Exam
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                            <h5>No Exams Available</h5>
                            <p class="text-muted">There are no exams available at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection