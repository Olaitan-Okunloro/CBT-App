@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success">
            <i class="fas fa-cog me-2"></i>Settings
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('referrer.settings.update') }}">
                @csrf

                <div class="form-check form-switch mb-4">

                    <input class="form-check-input"
                           type="checkbox"
                           name="email_alerts"
                           id="email_alerts"
                           {{ $user->email_alerts ? 'checked' : '' }}>

                    <label class="form-check-label"
                           for="email_alerts">
                        Enable Email Notifications
                    </label>

                </div>

                <hr>

                <h6 class="mb-3">Default Bank Details</h6>

                <div class="mb-3">
                    <label>Bank Name</label>

                    <input type="text"
                           name="bank_name"
                           class="form-control"
                           value="{{ $user->bank_name }}">
                </div>

                <div class="mb-3">
                    <label>Account Name</label>

                    <input type="text"
                           name="account_name"
                           class="form-control"
                           value="{{ $user->account_name }}">
                </div>

                <div class="mb-3">
                    <label>Account Number</label>

                    <input type="text"
                           name="account_number"
                           class="form-control"
                           value="{{ $user->account_number }}">
                </div>

                <button class="btn btn-success">
                    Save Settings
                </button>

            </form>

        </div>

    </div>

</div>
@endsection