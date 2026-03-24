<!-- resources/views/payment/cancel.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Payment Cancelled</h4>
                </div>

                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-warning" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h3>Payment Cancelled</h3>
                    <p class="lead">Your payment was not completed.</p>
                    
                    <div class="alert alert-info">
                        <p class="mb-0">You can try again or contact support if you need assistance.</p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('payment.show') }}" class="btn btn-primary">
                            <i class="fas fa-credit-card me-2"></i>Try Again
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-home me-2"></i>Go Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection