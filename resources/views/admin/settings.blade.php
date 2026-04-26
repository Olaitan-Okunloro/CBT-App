@extends('layouts.app')

@section('title', 'Admin Settings')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <i class="fas fa-cog me-2"></i>
            System Settings
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('admin.settings.update') }}">
                @csrf

                <div class="mb-3">
                    <label>Main Subscription Fee</label>

                    <input type="number"
                           name="sub_amount"
                           class="form-control"
                           value="{{ $sub->sub_amount }}">
                </div>

                <div class="mb-3">
                    <label>Email Notification Fee</label>

                    <input type="number"
                           name="email_sub"
                           class="form-control"
                           value="{{ $sub->email_sub }}">
                </div>

                <button class="btn btn-success">
                    Save Settings
                </button>

            </form>

        </div>

    </div>

</div>
@endsection