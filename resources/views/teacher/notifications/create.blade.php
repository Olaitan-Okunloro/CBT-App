{{-- resources/views/teacher/notifications/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Send Notification to Students')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-paper-plane me-2"></i>Send Notification to Students
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.notifications.send') }}" id="notificationForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Notification Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-heading"></i>
                                </span>
                                <input type="text" name="title" class="form-control" placeholder="e.g., Class Reminder, Exam Update" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Message <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-info text-white">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <textarea name="message" class="form-control" rows="5" placeholder="Type your message here..." required></textarea>
                            </div>
                        </div>

                        <!-- Select Recipients -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Send To</label>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="recipient_option" id="allStudents" value="all" checked>
                                    <label class="form-check-label" for="allStudents">
                                        All My Students ({{ $studentsCount }} students)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="recipient_option" id="selectStudents" value="selected">
                                    <label class="form-check-label" for="selectStudents">
                                        Select Specific Students
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Student Selection Table (Hidden by default) -->
                        <div id="studentSelection" style="display: none;">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                        <label class="form-check-label fw-bold" for="selectAll">
                                            Select All Students
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                    <div class="row">
                                        @foreach($students as $student)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input student-checkbox" 
                                                           type="checkbox" 
                                                           name="student_ids[]" 
                                                           value="{{ $student->user_id }}"
                                                           id="student_{{ $student->user_id }}">
                                                    <label class="form-check-label" for="student_{{ $student->user_id }}">
                                                        <strong>{{ $student->user->name }}</strong><br>
                                                        <small class="text-muted">{{ $student->user->email }} | {{ $student->class->name ?? 'No Class' }}</small>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note:</strong> Selected students will receive this notification immediately.
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100" id="sendBtn">
                            <i class="fas fa-paper-plane me-2"></i>Send Notification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle student selection table
document.querySelectorAll('input[name="recipient_option"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const studentSelection = document.getElementById('studentSelection');
        if (this.value === 'selected') {
            studentSelection.style.display = 'block';
        } else {
            studentSelection.style.display = 'none';
        }
    });
});

// Select All functionality
document.getElementById('selectAll')?.addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.student-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = this.checked;
    });
});

// Form submission validation
document.getElementById('notificationForm').addEventListener('submit', function(e) {
    const recipientOption = document.querySelector('input[name="recipient_option"]:checked').value;
    const selectedStudents = document.querySelectorAll('.student-checkbox:checked');
    
    if (recipientOption === 'selected' && selectedStudents.length === 0) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'No Students Selected',
            text: 'Please select at least one student to send the notification.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    const btn = document.getElementById('sendBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
});
</script>
@endsection