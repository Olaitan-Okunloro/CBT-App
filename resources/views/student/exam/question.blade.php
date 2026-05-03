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

        {{-- OBJECTIVE --}}
        @if($question->question_type === 'objective')

            @foreach($question->teacher_options as $option)
            <div>
                <label>
                    <input type="radio" name="answer" value="{{ $option->option_label }}" >
                    {{ $option->option_label }}. {{ $option->option_text }}
                </label>
            </div>
            @endforeach

        {{-- FILL IN THE GAP --}}
        @elseif($question->question_type === 'fill_in_the_gap')
            <input type="text" name="answer" class="form-control mt-3" placeholder="Enter your answer">
        @endif

        <button type="submit" class="btn btn-primary mt-3">Next</button>
</button>

</div>

<script>
    let endTime = new Date("{{ \Carbon\Carbon::parse(session('exam_end_time'))->toIso8601String() }}");
    let redirected = false; // ✅ prevent multiple redirects

    if("{{ session('no_back') }}"){
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    }

    function updateTimer(){
        let now = new Date();
        let diff = Math.floor((endTime - now)/1000);

        if(diff <= 0 && !redirected){
            redirected = true;

            window.location.href = "{{ route('student.exam.submit.auto') }}";
            return;
        }

        document.getElementById('timer').innerText = diff + " sec";
    }

    setInterval(updateTimer, 1000);
</script>

@endsection