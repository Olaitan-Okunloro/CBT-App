@extends('layouts.app')

@section('content')

<div class="container text-white">

<h3>📝 Exam Review</h3>

@foreach($attempt->answers as $index => $answer)

<div class="card mb-3 p-3">

    <p><strong>Q{{ $index + 1 }}:</strong> {{ $answer->question->question_text }}</p>

    {{-- OBJECTIVE --}}
    @if($answer->question->question_type === 'objective')

        @foreach($answer->question->teacher_options as $option)
            <div>
                {{ $option->option_label }}. {{ $option->option_text }}

                @if($option->option_label == $answer->question->correct_answer)
                    <span class="badge bg-success">Correct Answer</span>
                @endif

                @if($option->option_label == $answer->selected_option && !$answer->is_correct)
                    <span class="badge bg-danger">Your Answer</span>
                @endif
            </div>
        @endforeach

    {{-- FILL --}}
    @else
        <p>Your Answer: <strong>{{ $answer->selected_option }}</strong></p>
        <p>Correct Answer: <strong>{{ $answer->question->correct_answer }}</strong></p>
    @endif

    @if($answer->is_correct)
        <span class="badge bg-success">Correct</span>
    @else
        <span class="badge bg-danger">Wrong</span>
    @endif

</div>

@endforeach

</div><br>

<a href="{{ route('student.exams.available') }}" class="btn btn-primary mt-3">
    Take Another Exam
</a>

@endsection