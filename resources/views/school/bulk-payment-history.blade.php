@extends('layouts.app')

@section('title', 'Bulk Payment History')

@section('content')
<div class="container">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            Bulk Payment History
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Students</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($payments as $row)

                            <tr>
                                <td>{{ $row->reference }}</td>
                                <td>{{ $row->student_count }}</td>
                                <td>₦{{ number_format($row->amount,2) }}</td>
                                <td>{{ ucfirst($row->status) }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    No payment history found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <li>
                                    <a class="dropdown-item" href="{{ route('bulk.payment.receipt', $row->id) }}">
                                        <i class="fas fa-file-invoice-dollar me-2"></i>Download Receipt
                                    </a>
                                </li>

            </div>

            <div class="mt-3">
                {{ $payments->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>
@endsection