<!-- resources/views/dashboard/teacher.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="{{ route('teacher.questions.import') }}" method="POST" enctype="multipart/form-data">
@csrf

<input type="file" name="file">

<button class="btn btn-success">Upload Excel</button>

</form>


    </div>
</div>
@endsection