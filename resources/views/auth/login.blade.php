<!-- resources/views/auth/login.blade.php -->
@extends('layouts.guest')

@section('title', 'Login - AcademiCore')
@section('auth-title', 'Welcome Back')
@section('auth-subtitle', 'Please login to your account')

@section('auth-content')

<!-- Session Status -->
@if (session('status'))
    <div class="alert alert-success mb-4">
        <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}" id="loginForm">
    @csrf

    <!-- Email Address -->
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

    <!-- Password -->
    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-lock me-2 text-primary"></i>Password
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
    </div>

    <!-- Remember Me & Forgot Password Row
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label" for="remember_me">
                <i class="fas fa-clock me-1 text-muted"></i>Remember me
            </label>
        </div>
        
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-decoration-none small">
                <i class="fas fa-question-circle me-1"></i>Forgot Password?
            </a>
        @endif
    </div> -->

    <!-- In your login.blade.php, add this link -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>
        
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-decoration-none small">
                <i class="fas fa-question-circle me-1"></i>Forgot Password?
            </a>
        @endif
    </div>

    <!-- Login Button -->
    <button type="submit" class="btn btn-primary w-100" id="loginBtn">
        <i class="fas fa-sign-in-alt me-2"></i>Sign In
    </button>

    <!-- Divider -->
    <div class="divider">
        <span>New to AcademiCore?</span>
    </div>

    <!-- Register Link -->
    <div class="auth-footer">
        <p>Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
    </div>
</form>

<!-- Demo Credentials Alert (Optional - Remove in Production) -->
@if(app()->environment('local'))
    <div class="alert alert-info mt-4 mb-0" style="border-radius: 12px;">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Demo Credentials:</strong><br>
        <small>📧 admin@academicore.com / password: 12345678</small>
    </div>
@endif

<script>
// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

// Form validation with SweetAlert
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;
    
    if (!email || !password) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Missing Fields',
            text: 'Please enter both email and password.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    // Show loading state on button
    const btn = document.getElementById('loginBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Signing in...';
    
    // Allow form to submit
    return true;
});

// Add animation to form elements on page load
document.addEventListener('DOMContentLoaded', function() {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.animation = `fadeIn 0.5s ease ${index * 0.1}s both`;
    });
});

// Pre-fill demo credentials on click (Optional)
function fillDemoCredentials() {
    document.querySelector('input[name="email"]').value = 'admin@academicore.com';
    document.querySelector('input[name="password"]').value = '12345678';
    document.getElementById('remember_me').checked = true;
    toastr.success('Demo credentials filled!');
}
</script>

<style>
    /* Additional custom styles for login page */
    .form-group {
        animation: fadeIn 0.5s ease backwards;
    }
    
    #togglePassword {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }
    
    .form-check-input:checked {
        background-color: #6f42c1;
        border-color: #6f42c1;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 2px rgba(111, 66, 193, 0.25);
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .btn-primary {
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    .alert {
        border-radius: 12px;
        border: none;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #e8f4fd 0%, #f0f7ff 100%);
        color: #1a1a2e;
        border-left: 4px solid #6f42c1;
    }
    
    /* Social login divider */
    .divider {
        text-align: center;
        margin: 25px 0 20px;
        position: relative;
    }
    
    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e9ecef;
    }
    
    .divider span {
        background: white;
        padding: 0 15px;
        position: relative;
        color: #adb5bd;
        font-size: 0.85rem;
    }
    
    /* Demo credentials link styling */
    .demo-link {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .demo-link:hover {
        color: #6f42c1 !important;
        text-decoration: underline;
    }
</style>

@endsection