@extends('layouts.app')

@section('title', 'Referrer Dashboard')

@section('content')
<div class="container">

        {{-- 
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-danger text-white">
            <i class="fas fa-bullhorn me-2"></i>
            Announcements
        </div>
        <div class="card-body">
            @foreach($announcements as $row)
                <div class="border-bottom mb-3 pb-2">
                    <h6 class="mb-1">{{ $row->title }}</h6>
                    <p class="mb-1">{{ $row->message }}</p>
                    <small class="text-white">{{ $row->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    </div>
    --}}

    <!-- The modal will now popup automatically -->

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

        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Referred Students</h6>
                    <h3>{{ $studentRefs }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Referred Schools</h6>
                    <h3>{{ $schoolRefs }}</h3>
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