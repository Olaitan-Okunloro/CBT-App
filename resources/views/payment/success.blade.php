<!-- resources/views/payment/success.blade.php -->
@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h4 class="mb-0"><i class="fas fa-check-circle me-2"></i>Payment Successful</h4>
                </div>

                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h3>Thank You, {{ auth()->user()->name }}!</h3>
                    <p class="lead">Your payment has been processed successfully.</p>
                    
                    <div class="alert alert-success">
                        <i class="fas fa-info-circle me-2"></i>
                        Your account is now active. You can now access all features of the CBT platform.
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6>Registration Number</h6>
                                    <p class="h5 text-primary">{{ auth()->user()->studentDetail->registration_number }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6>Valid Until</h6>
                                    <p class="h5 text-success">{{ auth()->user()->studentDetail->payment_expiry->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                        </a>
                        <a href="{{ route('student.exams.available') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-book-open me-2"></i>Start Practicing
                        </a>
                    </div><br><br>
                    <a href="{{ route('payment.receipt', session('reference')) }}" class="btn btn-success">
                        Download Receipt
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection