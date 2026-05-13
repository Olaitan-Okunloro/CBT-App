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
                                                       placeholder="e.g., CBT Practice or First Term Examination if it real exam"
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
                                            <label class="form-label fw-bold">Term <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-dark text-white">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                                <select name="exams[0][term]" class="form-select" required>
                                                    <option value="">Select Term</option>
                                                    <option value="1st Term">1st Term</option>
                                                    <option value="2nd Term">2nd Term</option>
                                                    <option value="3rd Term">3rd Term</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Session <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-dark text-white">
                                                    <i class="fas fa-calendar-week"></i>
                                                </span>
                                                <input type="text"
                                                       name="exams[0][session]"
                                                       class="form-control"
                                                       placeholder="2025/2026"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Score Type <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-dark text-white">
                                                    <i class="fas fa-chart-line"></i>
                                                </span>
                                                <select name="exams[0][score_type]" class="form-select" required>
                                                    <option value="">Select Type</option>
                                                    <option value="cbt_practice">CBT Practice</option>
                                                    <option value="first_ca">First CA Test</option>
                                                    <option value="second_ca">Second CA Test</option>
                                                    <option value="exam">Examination</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Mark Per Question</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-dark text-white">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                                <input type="number"
                                                       name="exams[0][mark_per_question]"
                                                       class="form-control"
                                                       min="1"
                                                       value="1">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">
                                            Number of Questions
                                            <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">

                                            <span class="input-group-text bg-secondary text-white">
                                            <i class="fas fa-list-ol"></i>
                                            </span>

                                            <input type="number"
                                                name="exams[0][number_of_questions]"
                                                class="form-control"
                                                placeholder="e.g. 50"
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

<script>
let examCount = 1;

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
                               placeholder="e.g., First Term Examination"
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
                    <label class="form-label fw-bold">Term <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <select name="exams[${index}][term]" class="form-select" required>
                            <option value="">Select Term</option>
                            <option value="1st Term">1st Term</option>
                            <option value="2nd Term">2nd Term</option>
                            <option value="3rd Term">3rd Term</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Session <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white">
                            <i class="fas fa-calendar-week"></i>
                        </span>
                        <input type="text"
                               name="exams[${index}][session]"
                               class="form-control"
                               placeholder="2025/2026"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Score Type <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <select name="exams[${index}][score_type]" class="form-select" required>
                            <option value="">Select Type</option>
                            <option value="first_ca">First CA Test</option>
                            <option value="second_ca">Second CA Test</option>
                            <option value="exam">Examination</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Mark Per Question</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white">
                            <i class="fas fa-star"></i>
                        </span>
                        <input type="number"
                               name="exams[${index}][mark_per_question]"
                               class="form-control"
                               min="1"
                               value="1">
                    </div>
                </div>

                <!-- NEW FIELD: Number of Questions -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Number of Questions <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-secondary text-white">
                            <i class="fas fa-list-ol"></i>
                        </span>
                        <input type="number"
                               name="exams[${index}][number_of_questions]"
                               class="form-control"
                               placeholder="e.g. 50"
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

function renumberExams() {
    const exams = document.querySelectorAll('.exam-block');
    
    exams.forEach((exam, idx) => {
        exam.setAttribute('data-index', idx);
        
        const header = exam.querySelector('.card-header h5');
        if (header) {
            header.innerHTML = `<i class="fas fa-file-alt me-2"></i>Exam ${idx + 1}`;
        }
        
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

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('examsForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
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