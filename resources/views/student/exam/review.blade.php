@extends('layouts.app')

@section('content')

<div class="container text-white">

<h3>📝 Exam Review</h3>

@php
// ✅ Fetch saved questions ONCE (not inside loop)
$saved = DB::table('saved_questions')
    ->where('student_id', auth()->id())
    ->pluck('question_id')
    ->toArray();
@endphp

@foreach($attempt->answers as $index => $answer)

<div class="card mb-3 p-3">

    <p>
        <strong>Q{{ $index + 1 }}:</strong>
        {{ $answer->question->question_text }}
    </p>

    {{-- ⭐ SAVE BUTTON --}}
    <div class="mb-2 text-end">

        <button 
            onclick="toggleSave({{ $answer->question->id }}, this)"
            class="btn btn-sm {{ in_array($answer->question->id, $saved) ? 'btn-primary' : 'btn-outline-warning			warning' }}">

            {{ in_array($answer->question->id, $saved) ? '✅ Saved' : '⭐ Save Question' }}

        </button>

    </div>

    {{-- OBJECTIVE --}}
    @if($answer->question->question_type === 'objective')

        @foreach($answer->question->teacher_options as $option)

            <div>

                {{ $option->option_label }}.
                {{ $option->option_text }}

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

        <p>
            Your Answer:
            <strong>{{ $answer->selected_option }}</strong>
        </p>

        <p>
            Correct Answer:
            <strong>{{ $answer->question->correct_answer }}</strong>
        </p>

    @endif

    {{-- RESULT --}}
    <div class="mt-2">

        @if($answer->is_correct)
            <span class="badge bg-success">Correct</span>
        @else
            <span class="badge bg-danger">Wrong</span>
        @endif

    </div>

</div>

@endforeach

</div>

<br>

<a href="{{ route('student.exams.available') }}"
   class="btn btn-primary mt-3">

    Take Another Exam

</a><br><br>


<a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
    Back to the Dashboard
</a>

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