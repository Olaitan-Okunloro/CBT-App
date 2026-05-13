<!-- resources/views/school/classes/create.blade.php -->
@extends('layouts.app')

@section('title', 'Assign Classes to School')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary">
                    <h4 class="mb-0 text-white">
                        <i class="fas fa-school me-2"></i>Assign Classes to School
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('classes.store') }}" id="classesForm">
                        @csrf

                        <div id="classes-wrapper">
                            <div class="class-block card mb-4 border-left-primary" data-index="0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-layer-group me-2"></i>Class Assignment 1
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-danger remove-class" style="display: none;">
                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label fw-bold">Select Class <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-info">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                                <select name="classes[0][class_level_id]" class="form-select" required>
                                                    <option value="">Select Class</option>
                                                    @foreach($availableClasses as $class)
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
                            <button type="button" class="btn btn-success" onclick="addClass()">
                                <i class="fas fa-plus-circle me-2"></i>Add Another Class
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save All Classes
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
    .class-block {
        transition: all 0.3s ease;
    }
    .class-block:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .remove-class {
        transition: all 0.2s ease;
    }
    .remove-class:hover {
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
let classCount = 1;

function addClass() {
    let index = classCount;

    let html = `
    <div class="class-block card mb-4 border-left-primary fade-in" data-index="${index}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-layer-group me-2"></i>Class Assignment ${index + 1}
            </h5>
            <button type="button" class="btn btn-sm btn-danger remove-class" onclick="removeClass(this)">
                <i class="fas fa-trash-alt me-1"></i>Remove
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Select Class <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-info">
                            <i class="fas fa-users"></i>
                        </span>
                        <select name="classes[${index}][class_level_id]" class="form-select" required>
                            <option value="">Select Class</option>
                            @foreach($availableClasses as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

    document.getElementById('classes-wrapper').insertAdjacentHTML('beforeend', html);
    
    classCount++;
    
    if (classCount > 1) {
        const firstClass = document.querySelector('.class-block');
        if (firstClass) {
            const removeBtn = firstClass.querySelector('.remove-class');
            if (removeBtn) {
                removeBtn.style.display = 'block';
            }
        }
    }
}

function removeClass(button) {
    const classBlock = button.closest('.class-block');
    
    Swal.fire({
        title: 'Remove Class?',
        text: 'Are you sure you want to remove this class assignment?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            classBlock.remove();
            renumberClasses();
            toastr.success('Class removed successfully');
        }
    });
}

function renumberClasses() {
    const classes = document.querySelectorAll('.class-block');
    
    classes.forEach((classItem, idx) => {
        classItem.setAttribute('data-index', idx);
        
        const header = classItem.querySelector('.card-header h5');
        if (header) {
            header.innerHTML = `<i class="fas fa-layer-group me-2"></i>Class Assignment ${idx + 1}`;
        }
        
        const selects = classItem.querySelectorAll('select');
        selects.forEach(select => {
            const name = select.getAttribute('name');
            if (name) {
                const newName = name.replace(/classes\[\d+\]/, `classes[${idx}]`);
                select.setAttribute('name', newName);
            }
        });
    });
    
    classCount = classes.length;
    
    if (classCount === 1) {
        const firstClass = document.querySelector('.class-block');
        if (firstClass) {
            const removeBtn = firstClass.querySelector('.remove-class');
            if (removeBtn) {
                removeBtn.style.display = 'none';
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('classesForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity()) {
                this.reportValidity();
                return false;
            }
            
            Swal.fire({
                title: 'Save Class Assignments?',
                text: 'Are you sure you want to save all these class assignments?',
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