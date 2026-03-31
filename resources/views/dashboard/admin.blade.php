@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4" style="color:white">Admin Dashboard</h3>

    <div class="row">

        <div class="col-md-4">
        <div class="card bg-primary text-white">

        <div class="card-body">

        <h5>Schools</h5>

        <h2>{{ $schools }}</h2>

        </div>

        </div>
        </div>

        <div class="col-md-4">
        <div class="card bg-success text-white">

        <div class="card-body">

        <h5>Teachers</h5>

        <h2>{{ $teachers }}</h2>

        </div>

        

        </div>
        </div>

        <div class="col-md-4">
        <div class="card bg-info text-white">

        <div class="card-body">

        <h5>Students</h5>

        <h2>{{ $students }}</h2>

        </div>

        </div>
        </div>

    </div>

</div>

@endsection