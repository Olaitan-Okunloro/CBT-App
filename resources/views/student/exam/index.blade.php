@extends('layouts.app')

@section('content')

<div class="container">

<h4 class="mb-4">Available Exams</h4>

@if($exams->isEmpty())
    <div class="alert alert-warning">
        No exams available yet.
    </div>
@else

<div class="row">

@foreach($exams as $exam)

<div class="col-md-4">
    <div class="card mb-3 shadow-sm">
        <div class="card-body">

            <h5>{{ $exam->title }}</h5>

            <p>
                Subject: {{ $exam->subject->name ?? 'N/A' }} <br>
                Duration: {{ $exam->duration }} mins <br>
                Questions: {{ $exam->total_questions }}
            </p>

            <a href="{{ route('student.exam.start', $exam->id) }}" 
               class="btn btn-primary">
                Start Exam
            </a>

        </div>
    </div>
</div>

@endforeach

</div>

@endif

</div>

@endsection