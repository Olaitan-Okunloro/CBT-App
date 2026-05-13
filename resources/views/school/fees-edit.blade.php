@extends('layouts.app')

@section('title', 'Edit Fees')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary">
            Edit School Fees
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('school.fees.update', $fee->id) }}">
                @csrf

                <div class="mb-3">
                    <label>Class</label>

                    <select name="class_id"
                            class="form-control"
                            required>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ $fee->class_id == $class->id ? 'selected' : '' }}>

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
                           value="{{ $fee->term }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Session</label>

                    <input type="text"
                           name="session"
                           class="form-control"
                           value="{{ $fee->session }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Tuition</label>

                    <input type="number"
                           step="0.01"
                           name="tuition"
                           class="form-control"
                           value="{{ $fee->tuition }}">
                </div>

                <div class="mb-3">
                    <label>Uniforms</label>

                    <input type="number"
                           step="0.01"
                           name="uniforms"
                           class="form-control"
                           value="{{ $fee->uniforms }}">
                </div>

                <div class="mb-3">
                    <label>Books</label>

                    <input type="number"
                           step="0.01"
                           name="books"
                           class="form-control"
                           value="{{ $fee->books }}">
                </div>

                <button class="btn btn-success">
                    Update Fees
                </button>

            </form>

        </div>

    </div>

</div>
@endsection