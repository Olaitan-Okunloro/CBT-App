@extends('layouts.app')

@section('content')

<div class="container">

<h4>Create Exam</h4>

<form method="POST" action="{{ route('teacher.exams.store') }}">
@csrf

<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control">
</div>

<div class="mb-3">
    <label>Subject</label>
    <select name="subject_id" class="form-control">
        @foreach(\App\Models\Subject::all() as $subject)
        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Class</label>
    <select name="class_id" class="form-control">
        @foreach(\App\Models\SchoolClass::all() as $class)
        <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Exam Type</label>
    <select name="exam_cat_id" class="form-control">
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Total Questions</label>
    <input type="number" name="total_questions" class="form-control">
</div>

<div class="mb-3">
    <label>Duration (minutes)</label>
    <input type="number" name="duration" class="form-control">
</div>

<button class="btn btn-primary">Create Exam</button>

</form>

</div>

@endsection