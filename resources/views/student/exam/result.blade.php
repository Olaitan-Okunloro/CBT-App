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
    </div><br>

    <a href="{{ route('student.exam.pdf', $attempt->id) }}" class="btn btn-success">
        Download PDF
    </a><br><br>

    <a href="{{ route('student.exam.review', $attempt->id) }}" class="btn btn-info">
        Review Answers
    </a>

</div>

@endsection