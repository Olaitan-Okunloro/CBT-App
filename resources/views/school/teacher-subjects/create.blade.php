@extends('layouts.app')

@section('title', 'Assign Teacher to Subject')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Assign Teacher to Subject
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('school.teacher-subjects.store') }}" id="assignmentsForm">
                        @csrf

                        <div id="assignments-wrapper">
                            <!-- Assignment Block 0 (Initial) -->
                            <div class="assignment-block card mb-4 border-left-primary" data-index="0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-tasks me-2"></i>Assignment 1
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-danger remove-assignment" style="display: none;">
                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Teacher <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-info text-white">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <select name="assignments[0][teacher_id]" class="form-select" required>
                                                    <option value="">Select Teacher</option>
                                                    @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-book"></i>
                                                </span>
                                                <select name="assignments[0][subject_id]" class="form-select" required>
                                                    <option value="">Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark">
                                                    <i class="fas fa-layer-group"></i>
                                                </span>
                                                <select name="assignments[0][class_level_id]" class="form-select" required>
                                                    <option value="">Select Class</option>
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-success" onclick="addAssignment()">
                                <i class="fas fa-plus-circle me-2"></i>Add Another Assignment
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save All Assignments
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 4px solid #6f42c1;
    }
    .assignment-block {
        transition: all 0.3s ease;
    }
    .assignment-block:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .remove-assignment {
        transition: all 0.2s ease;
    }
    .remove-assignment:hover {
        transform: scale(1.05);
    }
    .input-group-text {
        font-weight: bold;
        min-width: 40px;
        justify-content: center;
    }
    select:focus {
        box-shadow: 0 0 0 0.2rem rgba(111,66,193,0.25);
        border-color: #6f42c1;
    }
    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
let assignmentCount = 1;

function addAssignment() {
    let index = assignmentCount;

    let html = `
    <div class="assignment-block card mb-4 border-left-primary fade-in" data-index="${index}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-tasks me-2"></i>Assignment ${index + 1}
            </h5>
            <button type="button" class="btn btn-sm btn-danger remove-assignment" onclick="removeAssignment(this)">
                <i class="fas fa-trash-alt me-1"></i>Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Teacher <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white">
                            <i class="fas fa-user"></i>
                        </span>
                        <select name="assignments[${index}][teacher_id]" class="form-select" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white">
                            <i class="fas fa-book"></i>
                        </span>
                        <select name="assignments[${index}][subject_id]" class="form-select" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-warning text-dark">
                            <i class="fas fa-layer-group"></i>
                        </span>
                        <select name="assignments[${index}][class_level_id]" class="form-select" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

    document.getElementById('assignments-wrapper').insertAdjacentHTML('beforeend', html);
    
    assignmentCount++;
    
    if (assignmentCount > 1) {
        const firstAssignment = document.querySelector('.assignment-block');
        if (firstAssignment) {
            const removeBtn = firstAssignment.querySelector('.remove-assignment');
            if (removeBtn) {
                removeBtn.style.display = 'block';
            }
        }
    }
}

function removeAssignment(button) {
    const assignmentBlock = button.closest('.assignment-block');
    
    Swal.fire({
        title: 'Remove Assignment?',
        text: 'Are you sure you want to remove this assignment?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            assignmentBlock.remove();
            renumberAssignments();
            toastr.success('Assignment removed successfully');
        }
    });
}

function renumberAssignments() {
    const assignments = document.querySelectorAll('.assignment-block');
    
    assignments.forEach((assignment, idx) => {
        assignment.setAttribute('data-index', idx);
        
        const header = assignment.querySelector('.card-header h5');
        if (header) {
            header.innerHTML = `<i class="fas fa-tasks me-2"></i>Assignment ${idx + 1}`;
        }
        
        const selects = assignment.querySelectorAll('select');
        selects.forEach(select => {
            const name = select.getAttribute('name');
            if (name) {
                const newName = name.replace(/assignments\[\d+\]/, `assignments[${idx}]`);
                select.setAttribute('name', newName);
            }
        });
    });
    
    assignmentCount = assignments.length;
    
    if (assignmentCount === 1) {
        const firstAssignment = document.querySelector('.assignment-block');
        if (firstAssignment) {
            const removeBtn = firstAssignment.querySelector('.remove-assignment');
            if (removeBtn) {
                removeBtn.style.display = 'none';
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('assignmentsForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity()) {
                this.reportValidity();
                return false;
            }
            
            Swal.fire({
                title: 'Save Assignments?',
                text: 'Are you sure you want to save all these assignments?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6f42c1',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                    }
                    form.submit();
                }
            });
        });
    }
});
</script>
@endsection