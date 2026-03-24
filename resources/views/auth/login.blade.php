<!-- resources/views/auth/login.blade.php -->
@extends('layouts.guest')

@section('title', 'Login - CBT App')
@section('auth-title', 'Welcome Back')
@section('auth-subtitle', 'Please login to your account')

@section('auth-content')
<!-- Session Status -->
@if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" 
               id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" 
               id="password" name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">Remember me</label>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #667eea;">
                Forgot your password?
            </a>
        @endif
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        <i class="fas fa-sign-in-alt me-2"></i>Log in
    </button>

    <div class="auth-footer">
        Don't have an account? <a href="{{ route('register') }}">Register here</a>
    </div>
</form>
@endsection