{{-- resources/views/notifications/index.blade.php --}}
@extends('layouts.app')

@section('title', 'All Notifications')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white">
            <i class="fas fa-bell me-2"></i>
            All Notifications
        </h3>
        <a href="{{ route('notifications.mark-all-read') }}" class="btn btn-outline-light">
            <i class="fas fa-check-double me-2"></i>Mark All as Read
        </a>
    </div>

    @if($notifications->count() > 0)
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <div class="list-group-item list-group-item-action p-3 {{ !$notification->is_read ? 'bg-light' : '' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        @if(!$notification->is_read)
                                            <span class="badge bg-danger me-2">New</span>
                                        @endif
                                        <h5 class="mb-0">{{ $notification->title }}</h5>
                                        @if($notification->priority == 'urgent')
                                            <span class="badge bg-danger ms-2">Urgent</span>
                                        @endif
                                    </div>
                                    
                                    <p class="mb-2">{{ $notification->message }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>From: {{ ucfirst($notification->sender_type) }}
                                            </small>
                                            <small class="text-muted ms-3">
                                                <i class="fas fa-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        
                                        @if(!$notification->is_read)
                                            <button class="btn btn-sm btn-primary mark-read" data-id="{{ $notification->id }}">
                                                <i class="fas fa-check me-1"></i>Mark as Read
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                <h5>No Notifications Yet</h5>
                <p class="text-muted">You don't have any notifications at this time.</p>
            </div>
        </div>
    @endif
</div>

<script>
document.querySelectorAll('.mark-read').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        
        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    });
});
</script>
@endsection