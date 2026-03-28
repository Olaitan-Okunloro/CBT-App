@extends('layouts.app')

@section('content')

<div class="container">

<h4 style="color:white">Available Exams</h4>

<div class="row">

@foreach($exams as $exam)

<div class="col-md-4">
    <div class="card mb-3">
        <div class="card-body">

            <h5>{{ $exam->title }}</h5>

            <p>
                Duration: {{ $exam->duration }} mins <br>
                Questions: {{ $exam->total_questions }}
            </p>

            <!-- ✅ PASTE IT RIGHT HERE -->
            <a href="{{ route('student.exam.start', $exam->id) }}" 
               class="btn btn-primary">
                Start Exam
            </a>

        </div>
    </div>
</div>

@endforeach

</div>

</div>

@endsection