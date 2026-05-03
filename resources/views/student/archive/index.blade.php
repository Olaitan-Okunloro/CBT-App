@extends('layouts.app')

@section('title', 'Saved Questions')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white mb-0"><i class="fas fa-star me-2"></i>Saved Questions ({{ $rows->count() }})</h3>
            @if(auth()->user()->savedQuestions()->count() > 0)
                <a href="{{ route('student.exam.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Create Exam
                </a>
            @endif
        </div>

        @if($rows->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <i class="fas fa-star fa-2x mb-3 d-block"></i>
                <h5>No saved questions yet</h5>
                <p class="mb-0">Save questions from practice sessions to build your exam here.</p>
                <a href="{{ route('student.practice') }}" class="btn btn-outline-warning mt-2">Start Practice</a>
            </div>
        @else
            <div class="row g-3">
                @foreach($rows as $index => $q)
                    <div class="col-lg-6 col-xl-4">
                        <div class="card h-100 shadow-sm border-0 saved-question-card" data-question-id="{{ $q->id }}">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-primary">Q{{ $index + 1 }}</span>
                                    <small class="text-muted">{{ $q->subject->name ?? 'General' }}</small>
                                </div>

                                <h6 class="question-text mb-3">{{ $q->question_text }}</h6>

                                {{-- OPTIONS --}}
                                @if($q->question_type === 'objective')
                                    <div class="options-container mb-3">
                                        @php
                                            $options = $q->options ?? collect();
                                        @endphp
                                        @forelse($options as $opt)
                                            <div class="option-item py-1">
                                                <span class="option-label fw-bold me-2">{{ $opt->option_label }}.</span>
                                                <span>{{ $opt->option_text }}</span>
                                            </div>
                                        @empty
                                            <small class="text-muted">No options available</small>
                                        @endforelse
                                    </div>
                                @else
                                    <div class="theory-badge badge bg-secondary mb-3">Theory Question</div>
                                @endif

                                {{-- ACTIONS --}}
                                <div class="d-flex gap-2 mt-auto">
                                    <button class="btn btn-sm btn-outline-danger remove-btn flex-grow-1" 
                                            onclick="toggleSave({{ $q->id }}, this)">
                                        <i class="fas fa-trash me-1"></i>Remove
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary preview-btn" 
                                            onclick="previewQuestion({{ $q->id }})">
                                        <i class="fas fa-eye me-1"></i>Preview
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($rows->hasPages())
                <div class="mt-4">
                    {{ $rows->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>

    {{-- PREVIEW MODAL --}}
    <div class="modal fade" id="previewModal" tabindex="-1" data-bs-theme="dark">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Question Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="previewContent"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function toggleSave(id, btn) {
    if (!confirm('Remove this question from saved?')) return;
    
    fetch(`/student/save-question/${id}`, { method: 'DELETE' })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'removed') {
                btn.closest('.saved-question-card').style.opacity = '0.5';
                btn.closest('.saved-question-card').style.transition = 'opacity 0.3s';
                setTimeout(() => {
                    btn.closest('.saved-question-card').remove();
                    updateCounter();
                }, 300);
            } else {
                alert(data.message || 'Error removing question');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Failed to remove question');
        });
}

function previewQuestion(id) {
    // Fetch full question data or use hidden data pattern from previous templates
    const previewDiv = document.getElementById(`preview-${id}`);
    const content = previewDiv ? previewDiv.innerHTML : 'Loading...';
    
    document.getElementById('previewContent').innerHTML = content;
    new bootstrap.Modal(document.getElementById('previewModal')).show();
}

function updateCounter() {
    const cards = document.querySelectorAll('.saved-question-card');
    const counter = document.querySelector('h3 .count');
    if (counter && cards.length > 0) {
        counter.textContent = `(${cards.length})`;
    }
}
</script>
@endpush

@push('styles')
<style>
.saved-question-card { transition: all 0.3s ease; }
.question-text { line-height: 1.4; color: #2c3e50; }
.option-item { border-left: 3px solid #3498db; padding-left: 12px; }
.options-container .option-item:nth-child(odd) { background: rgba(52,152,219,0.05); }
.theory-badge { font-size: 0.8em; }
</style>
@endpush