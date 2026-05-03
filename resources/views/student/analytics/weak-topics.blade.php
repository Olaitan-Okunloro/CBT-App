@extends('layouts.app')

@section('title', 'Weak Topics')

@section('content')
<div class="container">
    <h3 class="mb-3 text-white">📊 Performance Analysis</h3>

    {{-- WEAK TOPICS --}}
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            ⚠️ Weak Topics (Below 50%)
        </div>

        <div class="card-body">
            @if($weak->isEmpty())
                <p class="text-success">
                    🎉 No weak topics — great job!
                </p>
            @else
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Attempted</th>
                            <th>Correct</th>
                            <th>Accuracy</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($weak as $row)
                            <tr>
                                <td>{{ $row->topic }}</td>
                                <td>{{ $row->total }}</td>
                                <td>{{ $row->correct }}</td>
                                <td class="text-danger">
                                    {{ $row->accuracy }}%
                                </td>
                                <td>
                                    <a href="{{ route('student.practice.start', ['topic_id' => $row->id]) }}"
                                       class="btn btn-sm btn-warning">
                                        Practice
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- ALL TOPICS --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            📈 All Topics Performance
        </div>

        <div class="card-body">
            <table class="table table-bordered text-center">
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
                            <td class="{{ $row->accuracy < 50 ? 'text-danger' : 'text-success' }}">
                                {{ $row->accuracy }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection