@extends('layouts.app')

@section('content')

<div class="container ">
    <h3>📊 Performance Analytics</h3>

    <canvas id="chart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const data = @json($data);

new Chart(document.getElementById('chart'), {
    type: 'line',
    data: {
        labels: data.map(d => d.date),
        datasets: [{
            label: 'Average Score',
            data: data.map(d => d.avg_score)
        }]
    }
});
</script>

@endsection