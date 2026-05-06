@extends('layouts.app')

@section('content')

<style>
    .exam-container {
        color: #000; /* safer than white */
    }
</style>

<div class="container exam-container">

    {{-- 🚨 SAFETY CHECK --}}
    @if(!$question)
        <div class="alert alert-danger">
            Question not found. Redirecting...
        </div>

        <script>
            setTimeout(function () {
                window.location.href = "{{ route('student.exam.submit.auto') }}";
            }, 1500);
        </script>
    @else

        <h5>Question {{ $index + 1 }}</h5>

        <div class="alert alert-danger">
            Time Left: <span id="timer"></span>
        </div>

        <form method="POST" action="{{ route('student.exam.answer') }}">
            @csrf

            {{-- QUESTION --}}
            <p>{{ $question->question_text }}</p>

            {{-- OBJECTIVE --}}
            @if($question->question_type === 'objective')

                @foreach($question->teacher_options as $option)
                    <div class="form-check">
                        <input class="form-check-input"
                               type="radio"
                               name="answer"
                               value="{{ $option->option_label }}"
                               id="opt{{ $loop->index }}">

                        <label class="form-check-label" for="opt{{ $loop->index }}">
                            {{ $option->option_label }}. {{ $option->option_text }}
                        </label>
                    </div>
                @endforeach

            {{-- FILL IN THE GAP --}}
            @elseif($question->question_type === 'fill_in_the_gap')

                <input type="text"
                       name="answer"
                       class="form-control mt-3"
                       placeholder="Enter your answer">

            @endif

            <button type="submit" class="btn btn-primary mt-3">
                Next →
            </button>

        </form>

    @endif

</div>

{{-- TIMER --}}
<script>
    let endTime = new Date("{{ \Carbon\Carbon::parse(session('exam_end_time'))->toIso8601String() }}");
    let redirected = false;

    if ("{{ session('no_back') }}") {
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    }

    function updateTimer() {
        let now = new Date();
        let diff = Math.floor((endTime - now) / 1000);

        if (diff <= 0 && !redirected) {
            redirected = true;
            window.location.href = "{{ route('student.exam.submit.auto') }}";
            return;
        }

        document.getElementById('timer').innerText = diff + " sec";
    }

    updateTimer(); // run immediately
    setInterval(updateTimer, 1000);
</script>

@endsection