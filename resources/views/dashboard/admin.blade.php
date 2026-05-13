@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">
        <i class="fas fa-user-shield me-2"></i>
        Admin Dashboard
    </h3>

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card bg-primary">
                <div class="card-body text-center">
                    <h6>Schools</h6>
                    <h3>{{ $schools }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success">
                <div class="card-body text-center">
                    <h6>Teachers</h6>
                    <h3>{{ $teachers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info">
                <div class="card-body text-center">
                    <h6>Students</h6>
                    <h3>{{ $students }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning">
                <div class="card-body text-center">
                    <h6>Referrers</h6>
                    <h3>{{ $referrers }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Total Revenue</h6>
                    <h4>₦{{ number_format($revenue,2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger">
                <div class="card-body text-center">
                    <h6>Total Questions</h6>
                    <h4>{{ $questions }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-secondary">
                <div class="card-body text-center">
                    <h6>Results Uploaded</h6>
                    <h4>{{ $results }}</h4>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection