@extends('layouts.app')

@section('content')

<div class="container">

    <h3 style="color:white"><i class="fas fa-plus me-2" style="color:white"></i>Add Student</h3>

    <!-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif -->

    <form method="POST" action="{{ route('school.student.store') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label style="color:white">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label style="color:white">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email address" required>
        </div>

         <!-- Email -->
        <div class="mb-3">
            <label style="color:white">Phone</label>
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" required>
        </div>

        <!-- Class -->
        <div class="mb-3">
            <label style="color:white">Class</label>
            <select name="class_id" class="form-control" placeholder="Select Class" required>
                <option value="">Select Class</option>

                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-success">Create Student</button>

    </form>

</div>

@endsection