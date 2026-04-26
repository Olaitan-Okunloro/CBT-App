@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            Change Password
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('referrer.password.update') }}">
                @csrf

                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password"
                           name="current_password"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password"
                           name="new_password"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password"
                           name="new_password_confirmation"
                           class="form-control">
                </div>

                <button class="btn btn-success">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection