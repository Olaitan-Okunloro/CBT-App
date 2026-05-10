@extends('layouts.app')

@section('title', 'Add Multiple Teachers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Add Multiple Teachers
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('school.teacher.store') }}" id="teachersForm">
                        @csrf

                        <div id="teachers-wrapper">
                            <!-- Teacher Block 0 (Initial) -->
                            <div class="teacher-block card mb-4 border-left-primary" data-index="0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-chalkboard-teacher me-2"></i>Teacher 1
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-danger remove-teacher" style="display: none;">
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
                                                       name="teachers[0][name]" 
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
                                                       name="teachers[0][email]" 
                                                       class="form-control" 
                                                       placeholder="Enter Email Address"
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
                                                       name="teachers[0][phone]" 
                                                       class="form-control" 
                                                       placeholder="Enter Phone Number"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-warning text-dark">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                                <select name="teachers[0][class_id]" class="form-select" required>
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
                            <button type="button" class="btn btn-success" onclick="addTeacher()">
                                <i class="fas fa-plus-circle me-2"></i>Add Another Teacher
                            </button>
                            
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save All Teachers
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
    .teacher-block {
        transition: all 0.3s ease;
    }
    .teacher-block:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .remove-teacher {
        transition: all 0.2s ease;
    }
    .remove-teacher:hover {
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
let teacherCount = 1;

function addTeacher() {
    let index = teacherCount;

    let html = `
    <div class="teacher-block card mb-4 border-left-primary fade-in" data-index="${index}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-chalkboard-teacher me-2"></i>Teacher ${index + 1}
            </h5>
            <button type="button" class="btn btn-sm btn-danger remove-teacher" onclick="removeTeacher(this)">
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
                               name="teachers[${index}][name]" 
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
                               name="teachers[${index}][email]" 
                               class="form-control" 
                               placeholder="Enter Email Address"
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
                               name="teachers[${index}][phone]" 
                               class="form-control" 
                               placeholder="Enter Phone Number"
                               required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-warning text-dark">
                            <i class="fas fa-users"></i>
                        </span>
                        <select name="teachers[${index}][class_id]" class="form-select" required>
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

    document.getElementById('teachers-wrapper').insertAdjacentHTML('beforeend', html);
    
    teacherCount++;
    
    if (teacherCount > 1) {
        const firstTeacher = document.querySelector('.teacher-block');
        if (firstTeacher) {
            const removeBtn = firstTeacher.querySelector('.remove-teacher');
            if (removeBtn) {
                removeBtn.style.display = 'block';
            }
        }
    }
}

function removeTeacher(button) {
    const teacherBlock = button.closest('.teacher-block');
    
    Swal.fire({
        title: 'Remove Teacher?',
        text: 'Are you sure you want to remove this teacher?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            teacherBlock.remove();
            renumberTeachers();
            toastr.success('Teacher removed successfully');
        }
    });
}

function renumberTeachers() {
    const teachers = document.querySelectorAll('.teacher-block');
    
    teachers.forEach((teacher, idx) => {
        teacher.setAttribute('data-index', idx);
        
        const header = teacher.querySelector('.card-header h5');
        if (header) {
            header.innerHTML = `<i class="fas fa-chalkboard-teacher me-2"></i>Teacher ${idx + 1}`;
        }
        
        const inputs = teacher.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/teachers\[\d+\]/, `teachers[${idx}]`);
                input.setAttribute('name', newName);
            }
        });
    });
    
    teacherCount = teachers.length;
    
    if (teacherCount === 1) {
        const firstTeacher = document.querySelector('.teacher-block');
        if (firstTeacher) {
            const removeBtn = firstTeacher.querySelector('.remove-teacher');
            if (removeBtn) {
                removeBtn.style.display = 'none';
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('teachersForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity()) {
                this.reportValidity();
                return false;
            }
            
            Swal.fire({
                title: 'Save Teachers?',
                text: 'Are you sure you want to save all these teachers?',
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