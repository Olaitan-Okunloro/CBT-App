<!-- resources/views/auth/forgot-password.blade.php -->
@extends('layouts.guest')

@section('title', 'Forgot Password - CBT App')
@section('auth-title', 'Reset Password')
@section('auth-subtitle', 'Enter your email to receive a reset link')

@section('auth-content')
<!-- Session Status -->
@if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
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

    <button type="submit" class="btn btn-primary w-100 py-2 mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
    </button>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-decoration-none" style="color: #667eea;">
            <i class="fas fa-arrow-left me-1"></i>Back to Login
        </a>
    </div>
</form>
@endsection