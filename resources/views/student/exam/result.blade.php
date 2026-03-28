@extends('layouts.app')

@section('content')

<div class="container">

<h3 style="color:white">Exam Result</h3>

<div class="card">
    <div class="card-body">

        <h5>{{ $attempt->exam->title ?? 'Exam' }}</h5>

        <p>Score: {{ $attempt->score }} / {{ $attempt->total }}</p>

        <p>Date: {{ $attempt->created_at }}</p>

    </div>
</div>

<a href="{{ route('student.exams.available') }}" class="btn btn-primary mt-3">
    Take Another Exam
</a>

</div>

@endsection