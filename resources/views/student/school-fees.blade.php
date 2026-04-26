@extends('layouts.app')

@section('title', 'School Fees Payment')

@section('content')
<div class="container">
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card bg-primary text-white text-center">
                    <div class="card-body">
                        <h6>Total Fees</h6>
                        <h4>₦{{ number_format($totalFee,2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <h6>Paid</h6>
                        <h4>₦{{ number_format($paid,2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-danger text-white text-center">
                    <div class="card-body">
                        <h6>Balance</h6>
                        <h4>₦{{ number_format($balance,2) }}</h4>
                    </div>
                </div>
            </div>

        </div><br><br>
    
        <div class="card-header bg-success text-white">
            School Fees Payment
        </div>

        <div class="card-body">

            <form method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('student.school.fees.submit') }}">
                @csrf

                <div class="mb-3">
                    <label>Amount Paid</label>

                    <input type="number"
                           name="amount"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Reference / Teller No</label>

                    <input type="text"
                           name="reference_no"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Payment Date</label>

                    <input type="date"
                           name="payment_date"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Upload Proof</label>

                    <input type="file"
                           name="proof"
                           class="form-control">
                </div>

                <button class="btn btn-success">
                    Submit Payment
                </button>

            </form>

        </div>

    </div>

</div>
@endsection