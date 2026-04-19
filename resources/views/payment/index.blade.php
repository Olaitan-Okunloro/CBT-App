<!-- resources/views/payment/index.blade.php -->
@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Complete Your Registration</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>{{ $title }}: <strong>₦{{ number_format($amount) }}</strong></h5>
                        <p class="mb-0">Make payment to activate your account and access all features including:</p>
                        <ul class="mt-2 mb-0">
                            <li>Access to all available exams</li>
                            <li>Real-time chat with teachers</li>
                            <li>View your results and performance</li>
                            <li>One year validity period</li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5><i class="fas fa-user me-2 text-primary"></i>Your Details</h5>
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Name:</td>
                                            <td><strong>{{ $user->name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td><strong>{{ $user->email }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td><strong>{{ $user->phone }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Exam Type:</td>
                                            <td><strong>{{ $user->exam_type ?? 'N/A' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Exam Year:</td>
                                            <td><strong>{{ $user->exam_year ?? 'N/A' }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5><i class="fas fa-receipt me-2 text-success"></i>Payment Summary</h5>
                                    <table class="table table-sm">
                                        <tr>
                                            <td>{{ $title }}</td>
                                            <td class="text-end">₦{{ number_format($amount,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>VAT (0%)</td>
                                            <td class="text-end">₦0</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>Total</td>
                                            <td class="text-end text-primary">₦{{ number_format($amount) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary btn-lg" id="payButton" onclick="payWithPaystack()">
                            <i class="fas fa-lock me-2"></i>Pay ₦{{ number_format($amount) }} with Paystack
                        </button>
                        <p class="text-muted mt-2">
                            <small>Secure payment powered by <strong>Paystack</strong></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function payWithPaystack() {

        const button = document.getElementById('payButton');

        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

        fetch("{{ route('payment.initialize') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                amount: {{ $amount }}
            })
        })
        .then(response => response.json())
        .then(data => {

            if (data.success && data.authorization_url) {

                // Redirect to Paystack
                window.location.href = data.authorization_url;

            } else {

                button.disabled = false;
                button.innerHTML = '<i class="fas fa-lock me-2"></i>Pay ₦{{ number_format($amount) }} with Paystack>';

                alert(data.message || "Payment initialization failed.");
            }

        })
        .catch(error => {

            console.error(error);

            button.disabled = false;
            button.innerHTML = '<i class="fas fa-lock me-2"></i>Pay ₦{{ number_format($amount) }} with Paystack>';

            alert("Something went wrong. Please try again.");
        });
    }
</script>

@endsection