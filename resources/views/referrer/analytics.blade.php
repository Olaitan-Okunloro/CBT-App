@extends('layouts.app')

@section('title', 'Referral Analytics')

@section('content')
<div class="container">

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small class="text-muted">Wallet</small>
                    <h4>₦{{ number_format($wallet,2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small class="text-muted">Total Earnings</small>
                    <h4>₦{{ number_format($totalEarnings,2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small class="text-muted">Students</small>
                    <h4>{{ $studentRefs }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small class="text-muted">Schools</small>
                    <h4>{{ $schoolRefs }}</h4>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">
            Monthly Earnings Trend
        </div>

        <div class="card-body">
            <canvas id="earningsChart"></canvas>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = @json($monthly->pluck('month'));
const totals = @json($monthly->pluck('total'));

new Chart(document.getElementById('earningsChart'), {
    type: 'bar',
    data: {
        labels: labels.map(m => 'Month ' + m),
        datasets: [{
            label: 'Commission',
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