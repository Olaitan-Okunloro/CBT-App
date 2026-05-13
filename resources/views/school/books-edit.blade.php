@extends('layouts.app')

@section('title', 'Edit Books')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary">
            Edit Books List
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('school.books.update', $book->id) }}">
                @csrf

                <div class="mb-3">
                    <label>Class</label>

                    <select name="class_id"
                            class="form-control">

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ $book->class_id == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Term</label>

                    <input type="text"
                           name="term"
                           class="form-control"
                           value="{{ $book->term }}">
                </div>

                <div class="mb-3">
                    <label>Session</label>

                    <input type="text"
                           name="session"
                           class="form-control"
                           value="{{ $book->session }}">
                </div>

                <div class="mb-3">
                    <label>Textbooks</label>

                    <textarea name="textbooks"
                              class="form-control"
                              rows="3">{{ $book->textbooks }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Notebooks</label>

                    <input type="number" name="notebooks"
                              class="form-control"
                              rows="3">{{ $book->textbooks }}</input>
                </div>

                <div class="mb-3">
                    <label>Materials</label>

                    <textarea name="materials"
                              class="form-control"
                              rows="3">{{ $book->materials }}</textarea>
                </div>

                <button class="btn btn-success">
                    Update Books
                </button>

            </form>

        </div>

    </div>

</div>
@endsection