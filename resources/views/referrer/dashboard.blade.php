@extends('layouts.app')

@section('title', 'Referrer Dashboard')

@section('content')
<div class="container">

    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Wallet Balance</h6>
                    <h3>₦{{ number_format($wallet,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Earnings</h6>
                    <h3>₦{{ number_format($totalEarnings,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Referrals</h6>
                    <h3>{{ $totalRefs }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Referred Students</h6>
                    <h3>{{ $studentRefs }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Referred Schools</h6>
                    <h3>{{ $schoolRefs }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
    <div class="card shadow-sm border-0 text-center">
        <div class="card-body">

            <small class="text-muted">Referral Code</small>

            <h2 class="fw-bold text-success mt-2">
                {{ $referrer_code }}
            </h2>

            <button
                class="btn btn-sm btn-outline-success mt-2"
                onclick="navigator.clipboard.writeText('{{ $referrer_code }}')">

                <i class="fas fa-copy me-1"></i>Copy
            </button>

        </div>
    </div>
</div>

    </div>

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            Recent Commission History
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($commissions as $row)

                    <tr>
                        <td>₦{{ number_format($row->amount,2) }}</td>
                        <td>{{ ucfirst($row->type) }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center">
                            No earnings yet
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection