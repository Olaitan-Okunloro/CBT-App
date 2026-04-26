@extends('layouts.app')

@section('title', 'Admin Activity Logs')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <i class="fas fa-clock me-2"></i>
            Activity Logs
        </div>

        <div class="card-body">

            @if($logs->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Activity</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($logs as $log)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $log->activity }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y h:i A') }}
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>

            @else

                <div class="text-center text-muted py-4">
                    No activity records found.
                </div>

            @endif

        </div>

    </div>

</div>
@endsection