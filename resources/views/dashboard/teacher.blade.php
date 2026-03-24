@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="mb-4" style="color:white"><i class="fas fa-school me-2" style="color:white"></i>Teacher Dashboard</h3>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>My Questions</h5>
                    <h2> Questions goes here </h2>
                </div>
            </div>
        </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Students</h5>
                        <h2>Students goes here</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success mt-3">
        Welcome back Teacher <strong>{{ auth()->user()->name }}</strong>
    </div>
</div>

@endsection