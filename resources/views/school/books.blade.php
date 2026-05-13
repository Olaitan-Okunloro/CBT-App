@extends('layouts.app')

@section('title', 'School Books')

@section('content')
<div class="container">

    <div class="row g-4">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary">
                    Setup Books List
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('school.books.save') }}">
                        @csrf

                        <div class="mb-2">
                            <label>Class</label>

                            <select name="class_id"
                                    class="form-control">

                                @foreach($classes as $class)

                                    <option value="{{ $class->id }}">
                                        {{ $class->name }}
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Term</label>

                            <input type="text"
                                   name="term"
                                   class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Session</label>

                            <input type="text"
                                   name="session"
                                   class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Textbooks (List of textbooks separated by comma)</label>

                            <textarea name="textbooks"
                                      rows="3"
                                      class="form-control">
                            </textarea>
                        </div>

                        <div class="mb-2">
                            <label>Notebooks Qty</label>

                            <input type="text"
                                   name="notebooks"
                                   class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Materials (List of materials separated by comma)</label>

                            <textarea name="materials"
                                      rows="2"
                                      class="form-control"></textarea>
                        </div>

                        <button class="btn btn-success mt-3">
                            Save Books
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">
                    Existing Book Setup
                </div>

                <div class="card-body">

                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Session</th>
                                <th>Books</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($rows as $row)

                                <tr>

                                    <td>{{ $row->class_name }}</td>

                                    <td>{{ $row->term }}</td>

                                    <td>{{ $row->session }}</td>

                                    <td>{{ Str::limit($row->textbooks, 40) }}</td>

                                    <td>

                                        <a href="{{ route('school.books.edit', $row->id) }}"
                                        class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('school.books.delete', $row->id) }}"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete this record?')">
                                            @csrf

                                            <button class="btn btn-sm btn-danger">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    {{ $rows->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

</div>
@endsection