@extends('layouts.app')

@section('title', 'School Fees')

@section('content')
<div class="container">

    <div class="row g-4">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
                    Setup School Fees
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('school.fees.save') }}">
                        @csrf

                        <select name="class_id" class="form-control">

                            @foreach($classes as $class)

                                <option value="{{ $class->id }}">
                                    {{ $class->name }}
                                </option>

                            @endforeach

                        </select>

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
                            <label>Tuition</label>
                            <input type="number"
                                   name="tuition"
                                   class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Uniforms</label>
                            <input type="number"
                                   name="uniforms"
                                   class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Books</label>
                            <input type="number"
                                   name="books"
                                   class="form-control">
                        </div>

                        <button class="btn btn-success mt-3">
                            Save Fees
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-dark text-white">
                    Existing Fee Setup
                </div>

                <div class="card-body">

                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Session</th>
                                <th>Tuition</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($rows as $row)

                                <tr>
                                    <td>{{ $row->class_name ?? 'Unknown Class' }}</td>
                                    <td>{{ $row->term }}</td>
                                    <td>{{ $row->session }}</td>
                                    <td>₦{{ number_format($row->tuition,2) }}</td>

                                    <td>

                                        <a href="{{ route('school.fees.edit', $row->id) }}"
                                        class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                        <form method="POST"
                                            action="{{ route('school.fees.delete', $row->id) }}"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete this fee setup?')">
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