<!-- resources/views/student/external/practice.blade.php -->
@extends('layouts.app')

@section('title', 'Practice - External Student')

@section('content')
<div class="container">
    <div class="alert alert-info mb-4">
        <i class="fas fa-globe me-2"></i> 
        <strong>External Practice Mode:</strong> You are practicing from the public question bank.
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📚 Select Practice Parameters</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('student.external.practice.start') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Select Class</label>
                        <select name="class_id" class="form-select" id="class_id" required>
                            <option value="">-- Select Class --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Select Subject</label>
                        <select name="subject_id" class="form-select" id="subject_id" required>
                            <option value="">-- Select Subject --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Select Topic</label>
                        <select name="topic_id" class="form-select" id="topic_id" required>
                            <option value="">-- Select Topic --</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-play-circle me-2"></i>Start Practice
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('subject_id').addEventListener('change', function() {
    let subjectId = this.value;
    let topicSelect = document.getElementById('topic_id');
    
    if (!subjectId) {
        topicSelect.innerHTML = '<option value="">-- Select Topic --</option>';
        return;
    }
    
    topicSelect.innerHTML = '<option>Loading...</option>';
    
    fetch(`/get-topics/${subjectId}`)
        .then(res => res.json())
        .then(data => {
            let options = '<option value="">-- Select Topic --</option>';
            data.forEach(topic => {
                options += `<option value="${topic.id}">${topic.name}</option>`;
            });
            topicSelect.innerHTML = options;
        })
        .catch(() => {
            topicSelect.innerHTML = '<option value="">-- Error loading topics --</option>';
        });
});
</script>
@endsection