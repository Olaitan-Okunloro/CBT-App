@extends('layouts.app')

@section('title', 'Add Multiple Students')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Add Multiple Students
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('school.student.store') }}" id="studentsForm">
                        @csrf

                        <div id="students-wrapper">
                            <!-- Student Block 0 (Initial) -->
                            <div class="student-block card mb-4 border-left-primary" data-index="0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-user-graduate me-2"></i>Student 1
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-danger remove-student" style="display: none;">
                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input type="text" 
                                                       name="students[0][name]" 
                                                       class="form-control" 
                                                       placeholder="Enter Full Name"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-info text-white">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input type="email" 
                                                       name="students[0][email]" 
                                                       class="form-control" 
                                                       placeholder="Enter Email Address"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Parent Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-secondary text-white">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                                <input type="email" 
                                                       name="students[0][parent_email]" 
                                                       class="form-control" 
                                                       placeholder="Enter Parent Email"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                                <input type="tel" 
                                                       name="students[0][phone]" 
                                                       class="form-control" 
                                                       placeholder="Enter Phone Number"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark">
                                                    <i class="fas fa-layer-group"></i>
                                                </span>
                                                <select name="students[0][class_id]" class="form-select" required>
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

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <button type="button" class="btn btn-success" onclick="addStudent()">
                                    <i class="fas fa-plus-circle me-2"></i>Add Another Student
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save All Students
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Upload Modal -->
<div class="modal fade" id="bulkUploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 4px solid #6f42c1;
    }
    .student-block {
        transition: all 0.3s ease;
    }
    .student-block:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .remove-student {
        transition: all 0.2s ease;
    }
    .remove-student:hover {
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
let studentCount = 1;

function addStudent() {
    let index = studentCount;

    let html = `
    <div class="student-block card mb-4 border-left-primary fade-in" data-index="${index}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-user-graduate me-2"></i>Student ${index + 1}
            </h5>
            <button type="button" class="btn btn-sm btn-danger remove-student" onclick="removeStudent(this)">
                <i class="fas fa-trash-alt me-1"></i>Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" 
                               name="students[${index}][name]" 
                               class="form-control" 
                               placeholder="Enter Full Name"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-info text-white">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" 
                               name="students[${index}][email]" 
                               class="form-control" 
                               placeholder="Enter Email Address"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Parent Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-secondary text-white">
                            <i class="fas fa-users"></i>
                        </span>
                        <input type="email" 
                               name="students[${index}][parent_email]" 
                               class="form-control" 
                               placeholder="Enter Parent Email"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input type="tel" 
                               name="students[${index}][phone]" 
                               class="form-control" 
                               placeholder="Enter Phone Number"
                               required>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-warning text-dark">
                            <i class="fas fa-layer-group"></i>
                        </span>
                        <select name="students[${index}][class_id]" class="form-select" required>
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

    document.getElementById('students-wrapper').insertAdjacentHTML('beforeend', html);
    
    studentCount++;
    
    if (studentCount > 1) {
        const firstStudent = document.querySelector('.student-block');
        if (firstStudent) {
            const removeBtn = firstStudent.querySelector('.remove-student');
            if (removeBtn) {
                removeBtn.style.display = 'block';
            }
        }
    }
}

function removeStudent(button) {
    const studentBlock = button.closest('.student-block');
    
    Swal.fire({
        title: 'Remove Student?',
        text: 'Are you sure you want to remove this student?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            studentBlock.remove();
            renumberStudents();
            toastr.success('Student removed successfully');
        }
    });
}

function renumberStudents() {
    const students = document.querySelectorAll('.student-block');
    
    students.forEach((student, idx) => {
        student.setAttribute('data-index', idx);
        
        const header = student.querySelector('.card-header h5');
        if (header) {
            header.innerHTML = `<i class="fas fa-user-graduate me-2"></i>Student ${idx + 1}`;
        }
        
        const inputs = student.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/students\[\d+\]/, `students[${idx}]`);
                input.setAttribute('name', newName);
            }
        });
    });
    
    studentCount = students.length;
    
    if (studentCount === 1) {
        const firstStudent = document.querySelector('.student-block');
        if (firstStudent) {
            const removeBtn = firstStudent.querySelector('.remove-student');
            if (removeBtn) {
                removeBtn.style.display = 'none';
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('studentsForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity()) {
                this.reportValidity();
                return false;
            }
            
            Swal.fire({
                title: 'Save Students?',
                text: 'Are you sure you want to save all these students?',
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
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
                    }
                    form.submit();
                }
            });
        });
    }
});
</script>
@endsection