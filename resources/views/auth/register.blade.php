<!-- register.blade.php -->
@extends('layouts.guest')

@section('title', 'Register - AcademiCore')
@section('auth-title', 'Create Account')
@section('auth-subtitle', 'Join our School Management System platform today')

@section('auth-content')

<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    <!-- Full Name -->
    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-user me-2 text-primary"></i>Full Name
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-user"></i>
            </span>
            <input type="text" name="name" class="form-control" placeholder="e.g., John Doe" required>
        </div>
    </div>

    <!-- Email Address -->
    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-envelope me-2 text-primary"></i>Email Address
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
            <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
        </div>
    </div>

    <!-- Phone Number -->
    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-phone me-2 text-primary"></i>Phone Number
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-phone"></i>
            </span>
            <input type="tel" name="phone" class="form-control" placeholder="08012345678" required>
        </div>
    </div>

    <!-- Register As -->
    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-user-tag me-2 text-primary"></i>Register As
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-tag"></i>
            </span>
            <select class="form-select" name="user_type" id="user_type" required>
                <option value="">Select Account Type</option>
                <option value="student">🎓 Student</option>
                <option value="school">🏫 School</option>
                <option value="referrer">🤝 Referrer</option>
            </select>
        </div>
    </div>

    {{-- Student Section --}}
    <div id="studentSection" style="display:none;">
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-qrcode me-2 text-primary"></i>Referral Code (Optional)
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-gift"></i>
                </span>
                <input type="text" name="student_referral_code" class="form-control" placeholder="Enter referral code if you have one">
            </div>
            <small class="text-muted">📌 Enter a referral code to get discounts or bonuses</small>
        </div>
    </div>

    {{-- School Section --}}
    <div id="schoolSection" style="display:none;">
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-school me-2 text-primary"></i>School Name
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-building"></i>
                </span>
                <input type="text" name="school_name" class="form-control" placeholder="e.g., ABC International School">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-location-dot me-2 text-primary"></i>School Address
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-map-marker-alt"></i>
                </span>
                <input type="text" name="address" class="form-control" placeholder="Full address of school">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-qrcode me-2 text-primary"></i>Referral Code (Optional)
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-gift"></i>
                </span>
                <input type="text" name="school_referral_code" class="form-control" placeholder="Enter referral code if you have one">
            </div>
            <small class="text-muted">📌 Enter a referral code</small>
        </div>
    </div>

    <!-- Divider -->
    <div class="divider">
        <span>Security</span>
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
            <input type="password" name="password" class="form-control" placeholder="••••••••" id="password" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        <small class="text-muted">🔒 Minimum 8 characters with letters and numbers</small>
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label class="form-label">
            <i class="fas fa-lock me-2 text-primary"></i>Confirm Password
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-check-circle"></i>
            </span>
            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
        </div>
    </div>

    <!-- Terms & Conditions -->
    <div class="form-group mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
                I agree to the <a href="#" class="text-primary fw-bold">Terms of Service</a> and <a href="#" class="text-primary fw-bold">Privacy Policy</a>
            </label>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100" id="registerBtn">
        <i class="fas fa-user-plus me-2"></i>Create Account
    </button>

    <!-- Login Link -->
    <div class="auth-footer">
        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
    </div>
</form>

<script>
// Toggle user type sections
document.getElementById('user_type').addEventListener('change', function () {
    document.getElementById('studentSection').style.display = 'none';
    document.getElementById('schoolSection').style.display = 'none';

    if (this.value === 'student') {
        document.getElementById('studentSection').style.display = 'block';
        document.getElementById('studentSection').style.animation = 'fadeIn 0.5s ease';
    }

    if (this.value === 'school') {
        document.getElementById('schoolSection').style.display = 'block';
        document.getElementById('schoolSection').style.animation = 'fadeIn 0.5s ease';
    }
});

// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
});

// Form validation with SweetAlert
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
    const terms = document.getElementById('terms').checked;
    
    if (password !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Password Mismatch',
            text: 'Passwords do not match. Please try again.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    if (password.length < 8) {
        Swal.fire({
            icon: 'error',
            title: 'Weak Password',
            text: 'Password must be at least 8 characters long.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    if (!terms) {
        Swal.fire({
            icon: 'warning',
            title: 'Terms & Conditions',
            text: 'Please agree to the Terms of Service and Privacy Policy.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    // Submit the form
    this.submit();
});

// Add animation to form elements on page load
document.addEventListener('DOMContentLoaded', function() {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.animation = `fadeIn 0.5s ease ${index * 0.05}s both`;
    });
});
</script>

<style>
    /* Additional custom styles for register page */
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
</style>

@endsection