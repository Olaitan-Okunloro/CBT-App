@extends('layouts.app')

@section('content')

<div class="container">
    <h3 style="color:white"><i class="fas fa-download me-2"></i>Download Student Credentials</h3>

    @if(empty($students))
        <div class="alert alert-warning">
            No students uploaded.
        </div>
    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['email'] }}</td>
                <td>{{ $student['password'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('school.students.download') }}" class="btn btn-success">
        Download Excel
    </a>
    @endif
</div>
@endsection