<!-- resources/views/student/take-exam.blade.php -->
@extends('layouts.app')

@section('title', $exam->title)

@section('content')
<div class="container">
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        This is a placeholder for the exam interface. The actual exam taking functionality will be implemented next.
    </div>
    
    <div class="card">
        <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h4 class="mb-0">{{ $exam->title }}</h4>
        </div>
        <div class="card-body">
            <h5>Exam Details:</h5>
            <ul>
                <li>Duration: {{ $exam->duration }} minutes</li>
                <li>Total Marks: {{ $exam->total_marks }}</li>
                <li>Questions: {{ $exam->questions->count() }}</li>
            </ul>
            
            <div class="text-center mt-4">
                <a href="{{ route('student.exams.available') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Exams
                </a>
            </div>
        </div>
    </div>
</div>
@endsection