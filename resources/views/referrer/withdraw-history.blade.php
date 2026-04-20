@extends('layouts.app')

@section('title', 'Withdrawal History')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">
            <i class="fas fa-money-bill-wave me-2"></i>
            Withdrawal History
        </div>

        <div class="card-body">

            @if($withdrawals->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($withdrawals as $row)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        ₦{{ number_format($row->amount,2) }}
                                    </td>

                                    <td>

                                        @if($row->status == 'paid')
                                            <span class="badge bg-success">
                                                Paid
                                            </span>

                                        @elseif($row->status == 'pending')
                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @else
                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y h:i A') }}
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $withdrawals->links('pagination::bootstrap-5') }}
                </div>

            @else

                <div class="text-center text-muted py-4">
                    No withdrawal records yet.
                </div>

            @endif

        </div>

    </div>

</div>
@endsection