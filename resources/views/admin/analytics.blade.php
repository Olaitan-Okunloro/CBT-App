@extends('layouts.app')

@section('title', 'Admin Analytics')

@section('content')

@php
    $months = collect($monthlyRevenuePayments)
        ->pluck('month')
        ->merge(collect($monthlyRevenueBulk)->pluck('month'))
        ->unique()
        ->values();

    $paymentMap = collect($monthlyRevenuePayments)
        ->pluck('total', 'month');

    $bulkMap = collect($monthlyRevenueBulk)
        ->pluck('total', 'month');

    $totals = $months->map(function ($month) use ($paymentMap, $bulkMap) {
        return ($paymentMap[$month] ?? 0) + ($bulkMap[$month] ?? 0);
    });
@endphp

<div class="container">

    <h3 class="mb-4">
        <i class="fas fa-chart-line me-2"></i>
        Admin Analytics
    </h3>

    <div class="row g-4">

        <!-- Total Revenue Chart -->
        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-success">
                    Monthly Total Revenue
                </div>

                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>

            </div>

        </div>

        <!-- Payout Chart -->
        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-danger">
                    Monthly Withdrawals Paid
                </div>

                <div class="card-body">
                    <canvas id="payoutChart"></canvas>
                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const revenueLabels = @json($months);
    const revenueData   = @json($totals);

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Revenue (₦)',
                data: revenueData,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    const payoutLabels = @json($monthlyPayout->pluck('month'));
    const payoutData   = @json($monthlyPayout->pluck('total'));

    new Chart(document.getElementById('payoutChart'), {
        type: 'line',
        data: {
            labels: payoutLabels,
            datasets: [{
                label: 'Paid Withdrawals (₦)',
                data: payoutData,
                borderWidth: 2,
                tension: 0.3,
                fill: false
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

@endsection