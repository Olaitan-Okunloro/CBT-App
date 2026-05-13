@extends('layouts.app')

@section('content')

<div class="container ">

<h3>🏆 Leaderboard</h3>

<table class="table  mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leaders as $index => $leader)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $leader->user->name }}</td>
            <td>{{ $leader->exam->subject->name ?? 'N/A' }}</td>
            <td>{{ $leader->score }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection