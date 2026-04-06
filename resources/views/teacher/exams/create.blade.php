@extends('layouts.app')

@section('content')

<div class="container">

<h4 style="color:white"><i class="fas fa-plus me-2" style="color:white"></i>Create Exam</h4>

<form method="POST" action="{{ route('teacher.exams.store') }}">
@csrf

<div class="mb-3">
    <label style="color:white">Title</label>
    <input type="text" name="title" class="form-control">
</div>

<div class="mb-3">
    <label style="color:white">Subject</label>
    <select name="subject_id" class="form-control">
        @foreach(\App\Models\Subject::all() as $subject)
        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label style="color:white">Exam Type</label>
    <select name="exam_cat_id" class="form-control">
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->category }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label style="color:white">Total Questions</label>
    <input type="number" name="total_questions" class="form-control">
</div>

<div class="mb-3">
    <label style="color:white">Duration (minutes)</label>
    <input type="number" name="duration" class="form-control">
</div>

<button class="btn btn-primary">Create Exam</button>

</form>

</div>

@endsection