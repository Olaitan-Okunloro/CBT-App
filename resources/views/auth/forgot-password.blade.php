<!-- resources/views/auth/forgot-password.blade.php -->
@extends('layouts.guest')

@section('title', 'Forgot Password - AcademiCore')
@section('auth-title', 'Reset Password')
@section('auth-subtitle', 'Enter your email to receive a reset link')

@section('auth-content')

@if (session('status'))
    <div class="alert alert-success mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
    @csrf

    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-envelope me-2 text-primary"></i>Email Address
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="alert alert-info mb-4">
        <i class="fas fa-info-circle me-2"></i>
        We'll send a password reset link to your email address.
    </div>

    <button type="submit" class="btn btn-primary w-100" id="sendResetBtn">
        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
    </button>

    <div class="auth-footer mt-4">
        <p>Remember your password? <a href="{{ route('login') }}">Back to Login</a></p>
    </div>
</form>

<script>
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    const email = document.querySelector('input[name="email"]').value;
    
    if (!email) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Email Required',
            text: 'Please enter your email address.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    const btn = document.getElementById('sendResetBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
});
</script>
@endsection