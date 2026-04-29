@extends('layouts.app')

@section('title', 'Topic Practice')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Topic Practice Mode
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ route('student.practice.start') }}">
                @csrf

                <div class="mb-3">
                    <label>Subject</label>
                    <select name="subject_id" class="form-control">
                        @foreach($subjects as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Topic</label>
                    <select name="topic_id" class="form-control">
                        @foreach($topics as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->topic }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Practice Type</label>
                    <select name="mode" class="form-control">
                        <option value="all">
                            Full Topic Practice
                        </option>

                        <option value="20">
                            Random 20
                        </option>

                        <option value="50">
                            Random 50
                        </option>

                        <option value="remaining">
                            Remaining Questions
                        </option>

                        <option value="wrong">
                            Wrong Answers Only
                        </option>
                    </select>
                </div>

                <button class="btn btn-success">
                    Start Practice
                </button>
            </form>
        </div>
    </div>
</div>
@endsection