@extends('layouts.app')

@section('content')

<div class="container">

<h5>Question {{ $index + 1 }}</h5>

<div class="alert alert-danger">
Time Left: <span id="timer"></span>
</div>

<form method="POST" action="{{ route('student.exam.answer') }}">
@csrf

<p>{{ $question->question_text }}</p>

@foreach($question->options as $option)
<div>
<label>
<input type="radio" name="answer" value="{{ $option->option_label }}" required>
{{ $option->option_label }}. {{ $option->option_text }}
</label>
</div>
@endforeach

<button class="btn btn-primary mt-3">Next</button>

</form>

</div>

<script>

// 🔥 TIMER SYNC WITH SERVER
let endTime = "{{ session('exam_end_time') }}";

function updateTimer(){
    let now = new Date().getTime();
    let end = new Date(endTime).getTime();

    let diff = Math.floor((end - now)/1000);

    if(diff <= 0){
        window.location.href = "{{ route('student.exam.submit.auto') }}";
    }

    document.getElementById('timer').innerText = diff + " sec";
}

setInterval(updateTimer, 1000);

history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};

</script>

@endsection