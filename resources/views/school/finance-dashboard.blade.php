@extends('layouts.app')

@section('title', 'Finance Dashboard')

@section('content')
<div class="container">

    <h3 class="mb-4">
        Finance Dashboard
    </h3>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card bg-succes text-center">

                <div class="card-body">
                    <h6>Total Income</h6>

                    <h4>
                        ₦{{ number_format($confirmed, 2) }}
                    </h4>
                </div>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-center">

                <div class="card-body">
                    <h6>Total Debt</h6>
                    <h4>₦{{ number_format($totalDebt, 2) }}</h4>
                </div>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-primary text-center">

                <div class="card-body">
                    <h6>Students Paid</h6>

                    <h4>
                        {{ $studentsPaid }}
                    </h4>
                </div>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">

                <div class="card-body">
                    <h6>Total Students</h6>

                    <h4>
                        {{ $totalStudents }}
                    </h4>
                </div>

            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary">
            Monthly Income Trend
        </div>

        <div class="card-body">

            <canvas id="financeChart" height="100"></canvas>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('financeChart');

new Chart(ctx, {
    type: 'bar',

    data: {
        labels: [

            @foreach($monthly as $row)
                '{{ $row->month }}',
            @endforeach

        ],

        datasets: [{
            label: 'Income',

            data: [

                @foreach($monthly as $row)
                    {{ $row->total }},
                @endforeach

            ]
        }]
    }
});
</script>
@endsection