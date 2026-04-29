@extends('layouts.app')

@section('title', 'Practice Dashboard')

@section('content')
<div class="container">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <h4>{{ $totalAttempted }}</h4>
                <p>Total Attempted</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <h4>{{ $correct }}</h4>
                <p>Correct</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center p-3">
                <h4>{{ $wrong }}</h4>
                <p>Wrong</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Topic Performance
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm p-3 text-center">
                    <h4>
                        🔥 {{ $dailyStreak }} Day Streak
                    </h4>

                    <p class="mb-0">
                        Keep learning daily
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <canvas id="progressChart"
                            height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Topic</th>
                        <th>Attempted</th>
                        <th>Correct</th>
                        <th>Accuracy</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($topics as $row)
                        <tr>
                            <td>{{ $row->topic }}</td>
                            <td>{{ $row->total }}</td>
                            <td>{{ $row->correct }}</td>
                            <td>
                                {{ round(($row->correct / $row->total) * 100) }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = [
        @foreach($chart as $c)
            '{{ $c->day }}',
        @endforeach
    ];

    const totals = [
        @foreach($chart as $c)
            {{ $c->total }},
        @endforeach
    ];

    new Chart(
        document.getElementById('progressChart'),
        {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Practice',
                    data: totals,
                    fill: false,
                    tension: 0.3
                }]
            }
        }
    );
</script>
@endsection