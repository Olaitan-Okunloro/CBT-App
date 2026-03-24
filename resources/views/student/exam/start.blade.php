@extends('layouts.app')

@section('content')

<div class="container">

<h4>{{ $exam->title }}</h4>

<div class="alert alert-warning">
Time Left: <span id="timer">{{ $exam->duration * 60 }}</span> seconds
</div>

    <form method="POST" action="{{ route('student.exam.submit') }}">
    @csrf

    <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">

    @foreach($questions as $index => $question)

    <div class="card mb-3 p-3">

    <p><strong>Q{{ $index + 1 }}:</strong> {{ $question->question_text }}</p>

    @foreach($question->options as $option)
    <div>
    <label>
    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->option_label }}">
    {{ $option->option_label }}. {{ $option->option_text }}
    </label>
    </div>
    @endforeach

    </div>

    @endforeach

    <button class="btn btn-success">Submit Exam</button>

    </form>

</div>

<script>
let time = {{ $exam->duration * 60 }};

let timer = setInterval(function(){
    time--;

    document.getElementById('timer').innerText = time;

    if(time <= 0){
        clearInterval(timer);
        document.forms[0].submit();
    }
},1000);
</script>

@endsection