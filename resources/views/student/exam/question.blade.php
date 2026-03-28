@extends('layouts.app')

@section('content')

<style>
    .exam-container {
        color: white;
    }
</style>

<div class="container exam-container">

    <h5>Question {{ $index + 1 }}</h5>

    <div class="alert alert-danger">
        Time Left: <span id="timer"></span>
    </div>

    <form method="POST" action="{{ route('student.exam.answer') }}">
        @csrf

        <p>{{ $question->question_text }}</p>

        <input type="text" name="answer" class="form-control">

        <button type="submit" class="btn btn-primary mt-3">Next</button>

    </form>

</div>

<script>
let endTime = new Date("{{ \Carbon\Carbon::parse(session('exam_end_time'))->toIso8601String() }}");

function updateTimer(){
    let now = new Date();
    let diff = Math.floor((endTime - now)/1000);

    if(diff <= 0){
        window.location.href = "{{ route('student.exam.submit.auto') }}";
    }

    document.getElementById('timer').innerText = diff + " sec";
}

setInterval(updateTimer, 1000);
</script>

@endsection