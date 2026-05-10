<!-- resources/views/auth/reset-password.blade.php -->
@extends('layouts.guest')

@section('title', 'Reset Password - AcademiCore')
@section('auth-title', 'Create New Password')
@section('auth-subtitle', 'Please enter your new password')

@section('auth-content')

<form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm">
    @csrf
    
    <input type="hidden" name="token" value="{{ $token ?? '' }}">

    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-envelope me-2 text-primary"></i>Email Address
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   value="{{ $email ?? old('email') }}" placeholder="you@example.com" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-lock me-2 text-primary"></i>New Password
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-key"></i>
            </span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" placeholder="••••••••" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="fas fa-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <small class="text-muted">🔒 Password must be at least 8 characters</small>
    </div>

    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-lock me-2 text-primary"></i>Confirm New Password
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-check-circle"></i>
            </span>
            <input type="password" name="password_confirmation" class="form-control" 
                   placeholder="Confirm your password" required>
        </div>
    </div>

    <div class="alert alert-warning mb-4">
        <i class="fas fa-shield-alt me-2"></i>
        Choose a strong password that you don't use elsewhere.
    </div>

    <button type="submit" class="btn btn-primary w-100" id="resetBtn">
        <i class="fas fa-sync-alt me-2"></i>Reset Password
    </button>

    <div class="auth-footer mt-4">
        <p><a href="{{ route('login') }}">Back to Login</a></p>
    </div>
</form>

<script>
// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

// Form validation
document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Password Mismatch',
            text: 'Passwords do not match. Please try again.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    if (password.length < 8) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Weak Password',
            text: 'Password must be at least 8 characters long.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    const btn = document.getElementById('resetBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Resetting...';
});
</script>
@endsection