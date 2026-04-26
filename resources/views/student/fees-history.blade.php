@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">
            Payment History
        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Receipt</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rows as $row)

                        <tr>

                            <td>
                                ₦{{ number_format($row->amount, 2) }}
                            </td>

                            <td>
                                {{ $row->payment_date }}
                            </td>

                            <td>
                                {{ ucfirst($row->status) }}
                            </td>

                            <td>

                                @if($row->status == 'confirmed')

                                    <a href="{{ route('student.fees.receipt', $row->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-download me-2"></i>Receipt
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            {{ $rows->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>
@endsection