@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-warning">
            Edit Student
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('school.student.update', $row->id) }}">

                @csrf

                <div class="mb-3">

                    <label>Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $row->user->name }}">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ $row->user->email }}">

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ $row->user->phone }}">

                </div>

                <button class="btn btn-success">
                    Update Student
                </button>

            </form>

        </div>

    </div>

</div>
@endsection