@extends('layouts.app')

@section('title', 'School Fee Payments')

@section('content')
<div class="container">

    <h3 class="mb-4 text-white">
        <i class="fas fa-money-check-alt me-2"></i>
        School Fee Payments
    </h3>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Student</th>
                            <th>Reg No</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Proof</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rows as $row)

                            <tr>

                                <td>{{ $row->name }}</td>

                                <td>{{ $row->registration_number }}</td>

                                <td>
                                    ₦{{ number_format($row->amount,2) }}
                                </td>

                                <td>{{ $row->payment_date }}</td>

                                <td>

                                    @if($row->proof)

                                        <a href="{{ asset('storage/fees/' . $row->proof) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-info">
                                            View
                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                                <td>

                                    <span class="badge bg-{{ $row->status == 'confirmed' ? 'success' : 'warning text-dark' }}">
                                        {{ ucfirst($row->status) }}
                                    </span>

                                </td>

                                <td>

                                    @if($row->status == 'pending')

                                        <form method="POST"
                                              action="{{ route('school.fees.payments.confirm', $row->id) }}">
                                            @csrf

                                            <button class="btn btn-sm btn-success">
                                                Confirm
                                            </button>

                                        </form>

                                    @endif

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