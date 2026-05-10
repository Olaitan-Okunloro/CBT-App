@extends('layouts.app')

@section('content')

<style>
    .exam-container {
        color: #000;
    }

    .question-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .option-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 10px;
        transition: 0.2s ease;
        cursor: pointer;
    }

    .option-item:hover {
        background: #f8f9fa;
        border-color: #0d6efd;
    }

    .timer-box {
        font-size: 18px;
        font-weight: bold;
    }
</style>

<div class="container exam-container mt-4">

    {{-- SAFETY CHECK --}}
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

    <div class="question-card">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h5 class="mb-0">
                Question {{ $index + 1 }}
            </h5>

            <div class="alert alert-danger timer-box mb-0 py-2 px-3">
                ⏳ <span id="timer"></span>
            </div>

        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('student.exam.answer') }}">
            @csrf

            {{-- QUESTION --}}
            <div class="mb-4">
                <h5>
                    {!! nl2br(e($question->question_text)) !!}
                </h5>
            </div>

            {{-- OBJECTIVE --}}
            @if($question->question_type === 'objective')

                {{-- INTERNAL QUESTIONS --}}
                @if(session('question_source') !== 'question_bank')

                    @foreach($question->teacher_options as $option)

                        <label class="option-item d-block">

                            <input class="form-check-input me-2"
                                type="radio"
                                name="answer"
                                value="{{ $option->option_label }}"
                                required>

                            <strong>{{ $option->option_label }}.</strong>
                            {{ $option->option_text }}

                        </label>

                    @endforeach

                {{-- EXTERNAL QUESTIONS --}}
                @else

                    @foreach($question->options as $option)

                        <label class="option-item d-block">

                            <input class="form-check-input me-2"
                                type="radio"
                                name="answer"
                                value="{{ $option->option_label }}"
                                required>

                            <strong>{{ $option->option_label }}.</strong>
                            {{ $option->option_text }}

                        </label>

                    @endforeach

                @endif

            {{-- FILL IN THE GAP --}}
            @elseif($question->question_type === 'fill_in_the_gap')

                <input type="text"
                    name="answer"
                    class="form-control mt-3"
                    placeholder="Enter your answer"
                    required>

            @endif

            {{-- BUTTON --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    Next →
                </button>
            </div>

        </form>

    </div>

    @endif

</div>

{{-- TIMER --}}
<script>

    let endTime = new Date(
        "{{ \Carbon\Carbon::parse(session('exam_end_time'))->toIso8601String() }}"
    );

    let redirected = false;

    // prevent back button
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

            window.location.href =
                "{{ route('student.exam.submit.auto') }}";

            return;
        }

        let minutes = Math.floor(diff / 60);
        let seconds = diff % 60;

        document.getElementById('timer').innerText =
            minutes + "m " + seconds + "s";
    }

    updateTimer();

    setInterval(updateTimer, 1000);

</script>

@endsection