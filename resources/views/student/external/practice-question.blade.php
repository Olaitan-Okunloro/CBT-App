<!-- resources/views/student/external/practice-question.blade.php -->
@extends('layouts.app')

@section('title', 'Practice Mode')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-question-circle me-2"></i>Question {{ $currentIndex + 1 }} of {{ $total }}
                </h5>
                <span class="badge bg-warning text-dark">External Practice Mode</span>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Select the correct answer and click Next.
            </div>
            
            <div class="question-text mb-4">
                <h5>{{ $question->question_text }}</h5>
            </div>
            
            <div class="options-list">
                @php
                    $options = ['A', 'B', 'C', 'D'];
                @endphp
                
                @foreach($options as $option)
                    @php
                        $optionField = 'option_' . strtolower($option);
                    @endphp
                    @if($question->$optionField)
                        <div class="option-item mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="{{ $option }}" id="option_{{ $option }}">
                                <label class="form-check-label" for="option_{{ $option }}">
                                    <strong>{{ $option }}.</strong> {{ $question->$optionField }}
                                </label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <div class="mt-4 d-flex justify-content-between">
                <button class="btn btn-secondary" id="prevBtn" style="visibility: hidden;">Previous</button>
                <button class="btn btn-primary" id="nextBtn">Next Question <i class="fas fa-arrow-right ms-2"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
let currentIndex = {{ $currentIndex }};
let totalQuestions = {{ $total }};
let selectedAnswer = null;

document.querySelectorAll('input[name="answer"]').forEach(radio => {
    radio.addEventListener('change', function() {
        selectedAnswer = this.value;
    });
});

document.getElementById('nextBtn').addEventListener('click', function() {
    if (!selectedAnswer) {
        toastr.warning('Please select an answer before continuing.');
        return;
    }
    
    let formData = new FormData();
    formData.append('question_id', '{{ $question->id }}');
    formData.append('answer', selectedAnswer);
    formData.append('topic_id', '{{ $question->topic_id ?? 0 }}');
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch('{{ route("student.external.practice.submit") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_correct) {
            toastr.success('Correct! Great job!');
        } else {
            toastr.error('Wrong! The correct answer is ' + data.correct_answer);
        }
        
        // Move to next question
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        toastr.error('An error occurred. Please try again.');
    });
});
</script>
@endsection