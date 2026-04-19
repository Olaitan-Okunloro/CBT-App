@extends('layouts.app')

@section('title', 'Bulk Payment Analytics')

@section('content')
<div class="container">

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Payments</h6>
                    <h2>{{ $totalPayments }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Students Sponsored</h6>
                    <h2>{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Amount</h6>
                    <h2>₦{{ number_format($totalAmount,2) }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Monthly Spending Trend
        </div>

        <div class="card-body">
            <canvas id="paymentChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = @json($monthly->pluck('month'));
const totals = @json($monthly->pluck('total'));

const ctx = document.getElementById('paymentChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels.map(m => 'Month ' + m),
        datasets: [{
            label: 'Amount Paid',
            data: totals,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
</script>

@endsection