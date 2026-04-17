@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        My Activity Log
                    </h4>
                </div>

                <div class="card-body">
                    @forelse($logs as $log)
                        <div class="border-bottom py-2">
                            <strong>{{ $log->activity }}</strong><br>
                            <small class="text-muted">
                                {{ $log->created_at->format('d M Y h:i A') }}
                            </small>
                        </div>
                    @empty
                        <p class="text-muted">No activity found.</p>
                    @endforelse

                    <div class="mt-3">
                        {{ $logs->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection