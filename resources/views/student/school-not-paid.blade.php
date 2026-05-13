{{-- resources/views/student/school-not-paid.blade.php --}}
@extends('layouts.app')

@section('title', 'School Payment Pending')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0"><i class="fas fa-school me-2"></i>School Payment Pending</h4>
                </div>
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="fas fa-clock fa-5x text-warning"></i>
                    </div>
                    <h3>Your School Has Not Completed Bulk Payment</h3>
                    <p class="lead mt-3">Your school has not yet made the bulk payment for student subscriptions.</p>
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle me-2"></i>
                        Please contact your school administrator to complete the bulk payment process.
                    </div>
                    <hr>
                    <p class="text-muted">
                        Once your school completes the payment, your account will be activated automatically.
                    </p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection