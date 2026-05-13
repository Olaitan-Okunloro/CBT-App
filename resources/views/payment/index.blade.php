<!-- resources/views/payment/index.blade.php -->
@extends('layouts.app')

@section('title', 'Complete Payment')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background: hsl(300, 100%, 25%); color: white;">
                    <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>{{ $title }}</h4>
                </div>

                <div class="card-body">
                    @if($type != 'email_subscription')
                        <!-- Subscription Options -->
                        <div class="alert alert-info mb-4">
                            <h5><i class="fas fa-info-circle me-2"></i>Choose Your Subscription Plan</h5>
                            <p class="mb-0">Select the plan that best suits your needs. All plans include full access to all features.</p>
                        </div>
                        
                        <div class="row mb-4">
                            <!-- 4 Months Plan -->
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 subscription-card" data-duration="4" data-amount="{{ $subscriptionOptions['4_months']['amount'] }}">
                                    <div class="card-body text-center">
                                        <div class="subscription-icon mb-3">
                                            <i class="fas fa-calendar-alt fa-3x" style="color: hsl(300, 100%, 25%);"></i>
                                        </div>
                                        <h4>4 Months Plan</h4>
                                        <div class="display-6 fw-bold" style="color: hsl(300, 100%, 25%);">
                                            ₦{{ number_format($subscriptionOptions['4_months']['amount']) }}
                                        </div>
                                        <p class="text-muted">₦{{ number_format($subscriptionOptions['4_months']['amount'] / 4) }}/month</p>
                                        <hr>
                                        <ul class="list-unstyled text-start">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Full exam access</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Practice questions</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Performance tracking</li>
                                            <li><i class="fas fa-check-circle text-success me-2"></i>Chat support</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 8 Months Plan -->
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 subscription-card" data-duration="8" data-amount="{{ $subscriptionOptions['8_months']['amount'] }}">
                                    <div class="card-body text-center">
                                        <div class="subscription-icon mb-3">
                                            <i class="fas fa-calendar-check fa-3x" style="color: hsl(300, 100%, 25%);"></i>
                                        </div>
                                        <h4>8 Months Plan</h4>
                                        <div class="display-6 fw-bold" style="color: hsl(300, 100%, 25%);">
                                            ₦{{ number_format($subscriptionOptions['8_months']['amount']) }}
                                        </div>
                                        <p class="text-muted">₦{{ number_format($subscriptionOptions['8_months']['amount'] / 8) }}/month</p>
                                        <hr>
                                        <ul class="list-unstyled text-start">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Everything in 4 months</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Extended access period</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Priority support</li>
                                            <li><i class="fas fa-check-circle text-success me-2"></i>Save 0% vs monthly</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 12 Months Plan (Best Value) -->
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 subscription-card recommended" data-duration="12" data-amount="{{ $subscriptionOptions['12_months']['amount'] }}">
                                    <div class="recommended-badge">BEST VALUE</div>
                                    <div class="card-body text-center">
                                        <div class="subscription-icon mb-3">
                                            <i class="fas fa-crown fa-3x" style="color: #ffd700;"></i>
                                        </div>
                                        <h4>12 Months Plan</h4>
                                        <div class="display-6 fw-bold" style="color: hsl(300, 100%, 25%);">
                                            ₦{{ number_format($subscriptionOptions['12_months']['amount']) }}
                                        </div>
                                        <p class="text-muted">₦{{ number_format($subscriptionOptions['12_months']['amount'] / 12) }}/month</p>
                                        <hr>
                                        <ul class="list-unstyled text-start">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Everything in 8 months</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Best value for money</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>VIP support</li>
                                            <li><i class="fas fa-check-circle text-success me-2"></i>Save {{ $subscriptionOptions['12_months']['saving'] }}% annually</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="selectedDuration" value="4">
                        <input type="hidden" id="selectedAmount" value="{{ $subscriptionOptions['4_months']['amount'] }}">
                        
                    @else
                        <!-- Email Subscription (No options needed) -->
                        <div class="alert alert-info">
                            <h5><i class="fas fa-bell me-2"></i>{{ $title }}: <strong>₦{{ number_format($amount) }}</strong></h5>
                            <p class="mb-0">Subscribe to receive email notifications for important updates and announcements.</p>
                        </div>
                        <input type="hidden" id="selectedDuration" value="12">
                        <input type="hidden" id="selectedAmount" value="{{ $amount }}">
                    @endif
                    
                    <!-- User Details -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5><i class="fas fa-user me-2 text-primary"></i>Your Details</h5>
                                    <table class="table table-sm">
                                        <tr><br>                                            <td>Name:</td><td><strong>{{ $user->name }}</strong></td><br>                                            </tr>
                                        <tr><br>                                            <td>Email:</td><td><strong>{{ $user->email }}</strong></td><br>                                            </tr>
                                        <tr><br>                                            <td>Phone:</td><td><strong>{{ $user->phone }}</strong></td><br>                                            </tr>
                                        @if($type != 'email_subscription')
                                        <tr><br>                                            <td>Selected Plan:</td><td><strong id="selectedPlanLabel">4 Months</strong></td><br>                                            </tr>
                                        @endif
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
                                            <td>{{ $type == 'email_subscription' ? $title : 'Subscription Fee' }}</td>
                                            <td class="text-end">₦<span id="amountDisplay">{{ number_format($type == 'email_subscription' ? $amount : $subscriptionOptions['4_months']['amount']) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Processing Fee</td>
                                            <td class="text-end">₦0</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td>Total</td>
                                            <td class="text-end text-primary">₦<span id="totalDisplay">{{ number_format($type == 'email_subscription' ? $amount : $subscriptionOptions['4_months']['amount']) }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="btn btn-primary btn-lg" id="payButton">
                            <i class="fas fa-lock me-2"></i>Pay Now
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

<style>
    .subscription-card {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e0e0e0;
        position: relative;
    }
    
    .subscription-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .subscription-card.selected {
        border-color: hsl(300, 100%, 25%);
        background: rgba(128, 0, 128, 0.05);
    }
    
    .recommended {
        border-color: #ffd700;
    }
    
    .recommended-badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #ffd700;
        color: hsl(300, 100%, 25%);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }
    
    @media (max-width: 768px) {
        .recommended-badge {
            font-size: 10px;
            padding: 3px 10px;
        }
    }
</style>

<script>
    let selectedDuration = 4;
    let selectedAmount = {{ $type == 'email_subscription' ? $amount : $subscriptionOptions['4_months']['amount'] }};
    
    @if($type != 'email_subscription')
        // Subscription plan selection
        document.querySelectorAll('.subscription-card').forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                document.querySelectorAll('.subscription-card').forEach(c => {
                    c.classList.remove('selected');
                });
                
                // Add selected class to clicked card
                this.classList.add('selected');
                
                // Get selected duration and amount
                selectedDuration = parseInt(this.dataset.duration);
                selectedAmount = parseInt(this.dataset.amount);
                
                // Update hidden inputs
                document.getElementById('selectedDuration').value = selectedDuration;
                document.getElementById('selectedAmount').value = selectedAmount;
                
                // Update display
                let planLabel = '';
                if (selectedDuration === 4) planLabel = '4 Months';
                else if (selectedDuration === 8) planLabel = '8 Months';
                else planLabel = '12 Months (1 Year)';
                
                document.getElementById('selectedPlanLabel').innerText = planLabel;
                document.getElementById('amountDisplay').innerText = selectedAmount.toLocaleString();
                document.getElementById('totalDisplay').innerText = selectedAmount.toLocaleString();
            });
        });
    @endif
    
    // Payment initialization
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
                amount: selectedAmount,
                duration: selectedDuration
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.authorization_url) {
                window.location.href = data.authorization_url;
            } else {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-lock me-2"></i>Pay Now';
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Error',
                    text: data.message || "Payment initialization failed.",
                    confirmButtonColor: '#6f42c1'
                });
            }
        })
        .catch(error => {
            console.error(error);
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-lock me-2"></i>Pay Now';
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Something went wrong. Please try again.",
                confirmButtonColor: '#6f42c1'
            });
        });
    }
    
    document.getElementById('payButton').addEventListener('click', payWithPaystack);
</script>
@endsection