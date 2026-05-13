{{-- resources/views/school/notifications/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Send Notification')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-paper-plane me-2"></i>Send Notification
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('school.notifications.send') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Send To</label>
                            <select name="recipient_type" class="form-select" required>
                                <option value="students">All Students in School</option>
                                <option value="teachers">All Teachers in School</option>
                                <option value="all">Everyone (Students & Teachers)</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i>Send Notification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection