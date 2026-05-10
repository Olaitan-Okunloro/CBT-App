@extends('layouts.app')

@section('title', 'Admin Dashboard - Subjects & Topics')

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-white">
            <i class="fas fa-chalkboard-user me-2"></i>
            Admin Dashboard
        </h3>
        <span class="badge bg-success px-3 py-2">
            <i class="fas fa-chart-line me-1"></i>
            Overview
        </span>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total Subjects</small>
                            <h2 class="fw-bold mb-0">{{ $subjects->count() }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded p-3">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total Topics</small>
                            <h2 class="fw-bold mb-0">{{ $topics->count() }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded p-3">
                            <i class="fas fa-list-ul fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Total Questions</small>
                            <h2 class="fw-bold mb-0">{{ \App\Models\QuestionBank::count() }}</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded p-3">
                            <i class="fas fa-question-circle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">Avg. Questions/Topic</small>
                            <h2 class="fw-bold mb-0">
                                {{ $topics->count() > 0 ? round(\App\Models\QuestionBank::count() / $topics->count(), 1) : 0 }}
                            </h2>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded p-3">
                            <i class="fas fa-chart-bar fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subjects & Topics Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-table me-2"></i>
                    Subjects & Topics Overview
                </h5>
                <div>
                    <button class="btn btn-sm btn-outline-light" onclick="window.print()">
                        <i class="fas fa-print me-1"></i> Print
                    </button>
                    <button class="btn btn-sm btn-outline-light ms-2" id="exportBtn">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="subjectsTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">S/N</th>
                            <th width="20%">Subject</th>
                            <th width="40%">Topic</th>
                            <th width="15%">Questions</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topics as $index => $topic)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold text-primary">
                                        <i class="fas fa-book me-1"></i>
                                        {{ $topic->subject->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-tag me-1 text-muted"></i>
                                    {{ $topic->topic }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $topic->question_banks_count > 0 ? 'success' : 'secondary' }} px-3 py-2">
                                        <i class="fas fa-question-circle me-1"></i>
                                        {{ $topic->question_banks_count }}
                                    </span>
                                </td>
                                <td>
                                    @if($topic->question_banks_count > 0)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning text-dark">No Questions</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-info" onclick="viewQuestions({{ $topic->id }})" title="View Questions">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" onclick="editTopic({{ $topic->id }})" title="Edit Topic">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-database fa-3x text-muted mb-3 d-block"></i>
                                    No topics found. Please add topics to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing {{ $topics->firstItem() ?? 0 }} to {{ $topics->lastItem() ?? 0 }} 
                    of {{ $topics->total() ?? 0 }} topics
                </div>
                <div>
                    {{ $topics->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Subjects Summary Card -->
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-chart-pie me-2"></i>
                Subjects Summary
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S/N</th>
                            <th>Subject Name</th>
                            <th>Total Topics</th>
                            <th>Total Questions</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $index => $subject)
                            @php
                                $subjectTopics = $topics->where('subject_id', $subject->id);
                                $totalQuestions = $subjectTopics->sum('question_banks_count');
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $subject->name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $subject->topic_count }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $totalQuestions }}</span>
                                </td>
                                <td>
                                    @if($subject->topic_count > 0)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    No subjects found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function viewQuestions(topicId) {
    Swal.fire({
        title: 'View Questions',
        text: 'This will show all questions for this topic.',
        icon: 'info',
        confirmButtonColor: '#6f42c1'
    });
    // You can redirect to the questions list page
    // window.location.href = '/admin/questions?topic_id=' + topicId;
}

function editTopic(topicId) {
    Swal.fire({
        title: 'Edit Topic',
        text: 'This will open the topic edit form.',
        icon: 'info',
        confirmButtonColor: '#6f42c1'
    });
    // You can redirect to the edit page
    // window.location.href = '/admin/topics/' + topicId + '/edit';
}

// Export table data
document.getElementById('exportBtn')?.addEventListener('click', function() {
    let csv = [];
    let rows = document.querySelectorAll('#subjectsTable tr');
    
    for (let i = 0; i < rows.length; i++) {
        let row = [], cols = rows[i].querySelectorAll('td, th');
        
        for (let j = 0; j < cols.length; j++) {
            let text = cols[j].innerText.replace(/,/g, '');
            row.push(text);
        }
        
        csv.push(row.join(','));
    }
    
    let csvFile = new Blob([csv.join('\n')], {type: 'text/csv'});
    let downloadLink = document.createElement('a');
    downloadLink.download = 'subjects_topics_export.csv';
    downloadLink.href = URL.createObjectURL(csvFile);
    downloadLink.click();
});
</script>

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
    
    @media print {
        .btn, .navbar, .footer {
            display: none !important;
        }
        body {
            background: white;
        }
        .card {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>
@endpush

@endsection