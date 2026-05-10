@extends('layouts.app')

@section('content')

<div class="container text-white">

    <h3 class="mb-4">📝 Exam Review</h3>

    @php
        // ✅ Fetch saved questions ONCE
        $saved = DB::table('saved_questions')
            ->where('student_id', auth()->id())
            ->pluck('question_id')
            ->toArray();
    @endphp

    @foreach($attempt->answers as $index => $answer)

        @php
            // 🔥 NORMALIZE SOURCE
            $source = trim(strtolower($answer->question_source ?? ''));

            // 🔥 DETERMINE QUESTION SOURCE
            if ($source == 'question_bank') {

                $question = \App\Models\QuestionBank::with('options')
                    ->find($answer->question_id);

            } else {

                $question = \App\Models\Question::with('teacher_options')
                    ->find($answer->question_id);
            }

        @endphp

        {{-- 🚨 SAFETY --}}
        @if(!$question)

            <div class="alert alert-danger mb-3">
                Question not found.
            </div>

            @continue

        @endif

        <div class="card mb-3 p-3 text-dark">

            {{-- QUESTION --}}
            <p>
                <strong>Q{{ $index + 1 }}:</strong>
                {{ $question->question_text }}
            </p>

            {{-- SAVE BUTTON --}}
            <div class="mb-2 text-end">

                <button
                    onclick="toggleSave({{ $question->id }}, this)"
                    class="btn btn-sm {{ in_array($question->id, $saved) ? 'btn-success' : 'btn-outline-warning' }}">

                    {{ in_array($question->id, $saved) ? '✅ Saved' : '⭐ Save Question' }}

                </button>

            </div>

            {{-- OBJECTIVE --}}
            @if($question->question_type === 'objective')

                {{-- EXTERNAL QUESTIONS --}}
                @if($source == 'question_bank')

                    @foreach($question->options as $option)

                        <div class="mb-2">

                            <strong>{{ $option->option_label }}.</strong>
                            {{ $option->option_text }}

                            {{-- CORRECT ANSWER --}}
                            @if($option->option_label == $question->correct_answer)

                                <span class="badge bg-success">
                                    Correct Answer
                                </span>

                            @endif

                            {{-- STUDENT WRONG ANSWER --}}
                            @if(
                                $option->option_label == $answer->selected_option
                                && !$answer->is_correct
                            )

                                <span class="badge bg-danger">
                                    Your Answer
                                </span>

                            @endif

                        </div>

                    @endforeach

                {{-- INTERNAL QUESTIONS --}}
                @else

                    @foreach($question->teacher_options as $option)

                        <div class="mb-2">

                            <strong>{{ $option->option_label }}.</strong>
                            {{ $option->option_text }}

                            {{-- CORRECT ANSWER --}}
                            @if($option->option_label == $question->correct_answer)

                                <span class="badge bg-success">
                                    Correct Answer
                                </span>

                            @endif

                            {{-- STUDENT WRONG ANSWER --}}
                            @if(
                                $option->option_label == $answer->selected_option
                                && !$answer->is_correct
                            )

                                <span class="badge bg-danger">
                                    Your Answer
                                </span>

                            @endif

                        </div>

                    @endforeach

                @endif

            {{-- FILL IN THE GAP --}}
            @else

                <p>
                    Your Answer:
                    <strong>{{ $answer->selected_option }}</strong>
                </p>

                <p>
                    Correct Answer:
                    <strong>{{ $question->correct_answer }}</strong>
                </p>

            @endif

            {{-- EXPLANATION --}}
            @if(!empty($question->explanation))

                <div class="alert alert-info mt-3">

                    <strong>
                        📘 Explanation:
                    </strong>

                    <hr>

                    {!! nl2br(e($question->explanation)) !!}

                </div>

            @endif

            {{-- RESULT --}}
            <div class="mt-3">

                @if($answer->is_correct)

                    <span class="badge bg-success">
                        Correct
                    </span>

                @else

                    <span class="badge bg-danger">
                        Wrong
                    </span>

                @endif

            </div>

        </div>

    @endforeach

</div>

<br>


<a href="{{ route('dashboard') }}"
   class="btn btn-primary mt-3">
    ← Back to Dashboard
</a>

<!-- <div class="text-end mt-3">

    <a class="btn btn-outline-light"
       href="{{ route('dashboard') }}">

        ← Back to Dashboard

    </a>

</div> -->

{{-- JS --}}
<script>

function toggleSave(id, btn)
{
    fetch('/student/save-question/' + id)
    .then(res => res.json())
    .then(data => {

        if (data.status === 'saved') {

            btn.innerHTML = '✅ Saved';

            btn.classList.remove('btn-outline-warning');

            btn.classList.add('btn-success');

        } else {

            btn.innerHTML = '⭐ Save Question';

            btn.classList.remove('btn-success');

            btn.classList.add('btn-outline-warning');
        }

    });
}

</script>

@endsection