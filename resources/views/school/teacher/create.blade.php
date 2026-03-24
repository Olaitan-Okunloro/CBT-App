@extends('layouts.app')

@section('content')

<div class="container">

    <h3 style="color:white"><i class="fas fa-plus me-2" style="color:white"></i>Add Teacher</h3>

    <!-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif -->

    <form method="POST" action="{{ route('school.teacher.store') }}">
    @csrf

        <div class="mb-3">
            <label style="color:white">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
        </div>

        <div class="mb-3">
            <label style="color:white">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
        </div>

        <div class="mb-3">
            <label style="color:white">Phone</label>
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" required>
        </div>

        <div class="mb-3">
            <label style="color:white">Class</label>
            <select class="form-select" name="class_id">
                <option value="">Select Class</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}">
                {{ $class->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Create Teacher</button>

    </form>

</div>

@endsection