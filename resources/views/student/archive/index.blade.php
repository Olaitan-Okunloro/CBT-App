@extends('layouts.app')

@section('title', 'Saved Questions')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white mb-0">

                <i class="fas fa-star me-2"></i>

                Saved Questions

                <span class="count">
                    ({{ $rows->count() }})
                </span>

            </h3>
        </div>

        @if($rows->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <i class="fas fa-star fa-2x mb-3 d-block"></i>
                <h5>No saved questions yet</h5>
                <p class="mb-0">Save questions from practice sessions to build your exam here.</p>
                <a href="{{ route('student.practice.page') }}" class="btn btn-outline-warning mt-2">Start Practice</a>
            </div>
        @else
            <div class="row g-3">
                @foreach($rows as $index => $q)
                    <div class="col-lg-6 col-xl-4">
                        <div class="card h-100 shadow-sm border-0 saved-question-card" data-question-id="{{ $q->id }}">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-primary">Q{{ $index + 1 }}</span>
                                    <small class="text-muted">{{ $q->subject->name ?? 'INTERNAL' }}</small>
                                </div>

                                <h6 class="question-text mb-3">{{ $q->question_text }}</h6>

                                {{-- OPTIONS --}}
                                @if($q->question_type === 'objective')

                                    <div class="options-container mb-3">

                                        @php

                                            if (($q->question_source ?? '') == 'question_bank') {

                                                $options = $q->options ?? collect();

                                            } else {

                                                $options = $q->teacher_options ?? collect();
                                            }

                                        @endphp

                                        @forelse($options as $opt)

                                            <div class="option-item py-1">

                                                <span class="option-label fw-bold me-2">
                                                    {{ $opt->option_label }}.
                                                </span>

                                                <span>
                                                    {{ $opt->option_text }}
                                                </span>

                                            </div>

                                        @empty

                                            <small class="text-muted">
                                                No options available
                                            </small>

                                        @endforelse

                                    </div>

                                @else

                                    <div class="theory-badge badge bg-secondary mb-3">
                                        Theory Question
                                    </div>

                                @endif

                                {{-- HIDDEN PREVIEW CONTENT --}}
                                <div id="preview-{{ $q->id }}" class="d-none">

                                    <h4 class="mb-3" style="color:white">
                                        {{ $q->question_text }}
                                    </h4>

                                    @php

                                        if (($q->question_source ?? '') == 'question_bank') {

                                            $previewOptions = $q->options ?? collect();

                                        } else {

                                            $previewOptions = $q->teacher_options ?? collect();
                                        }

                                    @endphp

                                    {{-- OPTIONS --}}
                                    @foreach($previewOptions as $opt)

                                        <div class="border rounded p-2 mb-2" style="color:white">

                                            <strong>
                                                {{ $opt->option_label }}.
                                            </strong>

                                            {{ $opt->option_text }}

                                        </div>

                                    @endforeach

                                    {{-- EXPLANATION --}}
                                    @if(!empty($q->explanation))

                                        <div class="alert alert-info mt-4">

                                            <strong>
                                                📘 Explanation
                                            </strong>

                                            <hr>

                                            {!! nl2br(e($q->explanation)) !!}

                                        </div>

                                    @endif

                                </div>
                                {{-- ACTIONS --}}
                                <div class="d-flex gap-2 mt-auto">
                                    <button class="btn btn-sm btn-outline-danger remove-btn flex-grow-1" 
                                            onclick="toggleSave(
                                                        {{ $q->id }},
                                                        '{{ $q->question_source ?? 'questions' }}',
                                                        this
                                                    )">
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

function toggleSave(id, source, btn) {

    if (!confirm('Remove this question from saved?')) return;

    fetch(`/student/save-question/${id}?source=${source}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN':
                '{{ csrf_token() }}'
        }
    })

    .then(res => res.json())

    .then(data => {

        if (data.status === 'removed') {

            btn.closest('.saved-question-card')
                .style.opacity = '0.5';

            setTimeout(() => {

                btn.closest('.saved-question-card')
                    .remove();

                updateCounter();

            }, 300);

        } else {

            alert(data.message || 'Error removing question');
        }
    })

    .catch(err => {

        console.error(err);

        alert('Failed to remove question');
    });
}


function previewQuestion(id) {

    const previewDiv =
        document.getElementById(`preview-${id}`);

    const content =
        previewDiv
            ? previewDiv.innerHTML
            : 'Loading...';

    document.getElementById('previewContent')
        .innerHTML = content;

    new bootstrap.Modal(
        document.getElementById('previewModal')
    ).show();
}


function updateCounter() {

    const cards =
        document.querySelectorAll(
            '.saved-question-card'
        );

    const counter =
        document.querySelector('.count');

    if (counter) {

        counter.textContent =
            `(${cards.length})`;
    }

    if (cards.length === 0) {

        location.reload();
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