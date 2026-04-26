@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h4>Total Students</h4>
                <h2>{{ $total }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h4>Present</h4>
                <h2>{{ $present }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white p-3">
                <h4>Late</h4>
                <h2>{{ $late }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h4>Absent</h4>
                <h2>{{ $absent }}</h2>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($records as $row)
                <tr>
                    <td>{{ $row->student->user->name ?? 'N/A' }}</td>
                    <td>{{ $row->check_in_time }}</td>
                    <td>{{ $row->check_out_time }}</td>
                    <td>{{ ucfirst($row->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
        {{ $records->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection