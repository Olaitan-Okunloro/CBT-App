@extends('layouts.app')

@section('content')

<div class="container">

    <h3 style="color: white"><i class="fas fa-upload me-2"></i>Upload Students (Excel)</h3>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('school.students.import.post') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
        <label style="color: white">Select Excel File</label>
        <input type="file" name="file" class="form-control" required>
        </div>

        <button class="btn btn-primary">Upload</button>

    </form>

    <br>

    <p style="color: white"><strong>Format: Please, use the format below in your excel file!</strong></p>
    <pre style="color: white">
    name, email, class_id, phone
    John Doe, john@gmail.com, 1, 09043211245
    Jane Doe, jane@gmail.com, 2, 08012345678
    </pre>

</div>

@endsection