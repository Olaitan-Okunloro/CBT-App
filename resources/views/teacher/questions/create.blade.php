<!-- resources/views/dashboard/teacher.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ route('teacher.questions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label style="color: white">Subject</label>
                <select name="subject_id" class="form-control">
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label style="color: white">Class Level</label>
                <select name="class_level_id" class="form-control">
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label style="color: white">Question Type</label>
                <select name="question_type" class="form-control">
                    <option value="objective">Objective</option>
                    <option value="fill_gap">Fill in the Gap</option>
                    <option value="summary">Summary</option>
                </select>
            </div>

            <div class="mb-3">
                <label style="color: white">Question</label>
                <textarea name="question_text" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label style="color: white">Option A</label>
                <input type="text" name="option_a" class="form-control">
            </div>

            <div class="mb-3">
                <label style="color: white">Option B</label>
                <input type="text" name="option_b" class="form-control">
            </div>

            <div class="mb-3">
                <label style="color: white">Option C</label>
                <input type="text" name="option_c" class="form-control">
            </div>

            <div class="mb-3">
                <label style="color: white">Option D</label>
                <input type="text" name="option_d" class="form-control">
            </div>

            <div class="mb-3">
                <label style="color: white">Correct Answer</label>
                <select name="correct_answer" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <div class="mb-3">
                <label style="color: white">Difficulty</label>
                <select name="difficulty" class="form-control">
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
            </div>

            <div class="mb-3">
                <label style="color: white">Time Limit (seconds)</label>
                <select name="time_limit" class="form-control">
                    <option value="30">30 Seconds</option>
                    <option value="60">1 Minute</option>
                </select>
            </div>

            <button class="btn btn-primary">Save Question</button>

        </form>
    </div>
</div>
@endsection