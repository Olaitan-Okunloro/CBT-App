@extends('layouts.app')

@section('title', 'School Fees Receipt')

@section('content')
<div class="container">

    <div class="card shadow border-0">

        <div class="card-body p-5">

            <div class="text-center mb-4">

                <h3>{{ $row->school_name }}</h3>

                <h5 class="text-success">
                    SCHOOL FEES RECEIPT
                </h5>

            </div>

            <table class="table">

                <tr>
                    <th>Student Name</th>
                    <td>{{ $row->name }}</td>
                </tr>

                <tr>
                    <th>Reg No</th>
                    <td>{{ $row->registration_number }}</td>
                </tr>

                <tr>
                    <th>Amount Paid</th>
                    <td>₦{{ number_format($row->amount,2) }}</td>
                </tr>

                <tr>
                    <th>Reference No</th>
                    <td>{{ $row->reference_no }}</td>
                </tr>

                <tr>
                    <th>Payment Date</th>
                    <td>{{ $row->payment_date }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td class="text-success">Confirmed</td>
                </tr>

            </table>

            <div class="text-center mt-4">

                <button onclick="window.print()"
                        class="btn btn-primary">
                    Print Receipt
                </button>

            </div>

        </div>

    </div>

</div>
@endsection