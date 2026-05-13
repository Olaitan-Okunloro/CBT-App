@extends('layouts.app')

@section('title', 'Withdraw Funds')

@section('content')
<div class="container">

    <div class="card shadow-sm">

        <div class="card-header bg-success">
            Withdraw Funds
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('referrer.withdraw.submit') }}">
                @csrf

                <div class="mb-3">
                    <label>Amount</label>
                    <input type="number" name="amount" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Bank Name</label>
                    <input type="text" name="bank_name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Account Name</label>
                    <input type="text" name="account_name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Account Number</label>
                    <input type="text" name="account_number" class="form-control">
                </div>

                <button class="btn btn-success w-100">
                    Submit Withdrawal
                </button>

            </form>

        </div>

    </div>

</div>
@endsection