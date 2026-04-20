@extends('layouts.app')

@section('title', 'Withdrawal Management')

@section('content')
<div class="container">

    <div class="row g-3 mb-4">

        <div class="col-md-2">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small>Pending</small>
                    <h4>{{ $pending }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small>Approved</small>
                    <h4>{{ $approved }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small>Paid</small>
                    <h4>{{ $paid }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small>Total Requested</small>
                    <h5>₦{{ number_format($requestedAmount,2) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center border-0">
                <div class="card-body">
                    <small>Total Paid</small>
                    <h5>₦{{ number_format($paidAmount,2) }}</h5>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Withdrawal Requests
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="260">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rows as $row)

                            <tr>
                                <td>{{ $row->user->name ?? 'User' }}</td>

                                <td>
                                    ₦{{ number_format($row->amount,2) }}
                                </td>

                                <td>
                                    {{ $row->bank_name }}<br>
                                    <small>
                                        {{ $row->account_number }}
                                    </small>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                                </td>

                                <td>

                                    @if($row->status == 'pending')

                                        <form method="POST"
                                              action="{{ route('admin.withdraw.approve', $row->id) }}"
                                              class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success">
                                                Approve
                                            </button>
                                        </form>

                                        <form method="POST"
                                              action="{{ route('admin.withdraw.reject', $row->id) }}"
                                              class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">
                                                Reject
                                            </button>
                                        </form>

                                    @elseif($row->status == 'approved')

                                        <form method="POST"
                                              action="{{ route('admin.withdraw.paid', $row->id) }}"
                                              class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-primary">
                                                Mark Paid
                                            </button>
                                        </form>

                                    @endif

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $rows->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>
@endsection