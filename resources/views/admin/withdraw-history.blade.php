@extends('layouts.app')

@section('title', 'Withdrawal History')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            All Withdrawal History
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rows as $row)

                            <tr>
                                <td>{{ $row->user->name ?? 'User' }}</td>

                                <td>
                                    ₦{{ number_format($row->amount,2) }}
                                </td>

                                <td>{{ ucfirst($row->status) }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{ $rows->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>
@endsection