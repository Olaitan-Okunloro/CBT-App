@extends('layouts.app')

@section('title', 'Create Multiple Exams')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Create Multiple Exams
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.exams.store') }}" id="examsForm">
                        @csrf

                        <div id="exams-wrapper">
                            <!-- Exam Block 0 (Initial) -->
                            <div class="exam-block card mb-4 border-left-primary" data-index="0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-file-alt me-2"></i>Exam 1
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-danger remove-exam" style="display: none;">
                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Exam Title <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white">
                                                    <i class="fas fa-heading"></i>
                                                </span>
                                                <input type="text" 
                                                       name="exams[0][title]" 
                                                       class="form-control" 
                                                       placeholder="e.g., First Term Exam Or Practice English Test"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-info text-white">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                                <select name="exams[0][class_id]" class="form-select" required>
                                                    <option value="">Select Class</option>
                                                    @foreach(\App\Models\ClassLevel::all() as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-book"></i>
                                                </span>
                                                <select name="exams[0][subject_id]" class="form-select" required>
                                                    <option value="">Select Subject</option>
                                                    @foreach(\App\Models\Subject::all() as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Exam Type <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark">
                                                    <i class="fas fa-tag"></i>
                                                </span>
                                                <select name="exams[0][exam_cat_id]" class="form-select" required>
                                                    <option value="">Select Exam Type</option>
                                                    @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Total Questions <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-secondary text-white">
                                                    <i class="fas fa-list-ol"></i>
                                                </span>
                                                <input type="number" 
                                                       name="exams[0][total_questions]" 
                                                       class="form-control" 
                                                       placeholder="e.g., 50"
                                                       min="1"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Duration (minutes) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-danger text-white">
                                                    <i class="fas fa-clock"></i>
                                                </span>
                                                <input type="number" 
                                                       name="exams[0][duration]" 
                                                       class="form-control" 
                                                       placeholder="e.g., 60"
                                                       min="1"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-success" onclick="addExam()">
                                <i class="fas fa-plus-circle me-2"></i>Add Another Exam
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save All Exams
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
    .exam-block {
        transition: all 0.3s ease;
    }
    .exam-block:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .remove-exam {
        transition: all 0.2s ease;
    }
    .remove-exam:hover {
        transform: scale(1.05);
    }
    .input-group-text {
        font-weight: bold;
        min-width: 40px;
        justify-content: center;
    }
    input:focus, select:focus {
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
let examCount = 1;

/**
 * Add new exam
 */
function addExam() {
    let index = examCount;

    let html = `
    <div class="exam-block card mb-4 border-left-primary fade-in" data-index="${index}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-file-alt me-2"></i>Exam ${index + 1}
            </h5>
            <button type="button" class="btn btn-sm btn-danger remove-exam" onclick="removeExam(this)">
                <i class="fas fa-trash-alt me-1"></i>Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Exam Title <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-heading"></i>
                        </span>
                        <input type="text" 
                               name="exams[${index}][title]" 
                               class="form-control" 
                               placeholder="e.g., First Term Exam Or Practice English Test"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white">
                            <i class="fas fa-users"></i>
                        </span>
                        <select name="exams[${index}][class_id]" class="form-select" required>
                            <option value="">Select Class</option>
                            @foreach(\App\Models\ClassLevel::all() as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white">
                            <i class="fas fa-book"></i>
                        </span>
                        <select name="exams[${index}][subject_id]" class="form-select" required>
                            <option value="">Select Subject</option>
                            @foreach(\App\Models\Subject::all() as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Exam Type <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-warning text-dark">
                            <i class="fas fa-tag"></i>
                        </span>
                        <select name="exams[${index}][exam_cat_id]" class="form-select" required>
                            <option value="">Select Exam Type</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Total Questions <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-secondary text-white">
                            <i class="fas fa-list-ol"></i>
                        </span>
                        <input type="number" 
                               name="exams[${index}][total_questions]" 
                               class="form-control" 
                               placeholder="e.g., 50"
                               min="1"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Duration (minutes) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-danger text-white">
                            <i class="fas fa-clock"></i>
                        </span>
                        <input type="number" 
                               name="exams[${index}][duration]" 
                               class="form-control" 
                               placeholder="e.g., 60"
                               min="1"
                               required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

    document.getElementById('exams-wrapper').insertAdjacentHTML('beforeend', html);
    
    examCount++;
    
    // Show remove button for first exam if more than one exists
    if (examCount > 1) {
        const firstExam = document.querySelector('.exam-block');
        if (firstExam) {
            const removeBtn = firstExam.querySelector('.remove-exam');
            if (removeBtn) {
                removeBtn.style.display = 'block';
            }
        }
    }
}

/**
 * Remove exam
 */
function removeExam(button) {
    const examBlock = button.closest('.exam-block');
    
    Swal.fire({
        title: 'Remove Exam?',
        text: 'Are you sure you want to remove this exam?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            examBlock.remove();
            renumberExams();
            toastr.success('Exam removed successfully');
        }
    });
}

/**
 * Renumber exams after removal
 */
function renumberExams() {
    const exams = document.querySelectorAll('.exam-block');
    
    exams.forEach((exam, idx) => {
        // Update data-index
        exam.setAttribute('data-index', idx);
        
        // Update header number
        const header = exam.querySelector('.card-header h5');
        if (header) {
            header.innerHTML = `<i class="fas fa-file-alt me-2"></i>Exam ${idx + 1}`;
        }
        
        // Update all input names
        const inputs = exam.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/exams\[\d+\]/, `exams[${idx}]`);
                input.setAttribute('name', newName);
            }
        });
    });
    
    examCount = exams.length;
    
    // Hide remove button for first exam if only one remains
    if (examCount === 1) {
        const firstExam = document.querySelector('.exam-block');
        if (firstExam) {
            const removeBtn = firstExam.querySelector('.remove-exam');
            if (removeBtn) {
                removeBtn.style.display = 'none';
            }
        }
    }
}

/**
 * Form submission with SweetAlert confirmation
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('examsForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if form is valid
            if (!this.checkValidity()) {
                this.reportValidity();
                return false;
            }
            
            Swal.fire({
                title: 'Save Exams?',
                text: 'Are you sure you want to save all these exams?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6f42c1',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disable submit button
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                    }
                    // Submit the form
                    form.submit();
                }
            });
        });
    }
});
</script>
@endsection