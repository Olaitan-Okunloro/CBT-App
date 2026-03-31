@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4" style="color:white">Admin Dashboard</h3>

    <div class="row">

        <h3>Admin Analytics</h3>

    <p>Total Students: {{ $totalStudents }}</p>
    <p>Total Exams Taken: {{ $totalAttempts }}</p>
    <p>Average Score: {{ round($averageScore,2) }}</p>

</div>

@endsection