<!-- resources/views/admin/topics/bulk-upload.blade.php -->
@extends('layouts.app')

@section('title', 'Bulk Upload Topics')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-upload me-2"></i>Bulk Upload Topics
                    </h4>
                </div>

                <div class="card-body">
                    <!-- Instructions -->
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Instructions:</h5>
                        <ul class="mb-0">
                            <li>Download the template file below</li>
                            <li>Fill in your data using the format: <strong>class_level_id | subject_id | topic</strong></li>
                            <li>Save as Excel (.xlsx, .xls) or CSV file</li>
                            <li>Upload the file using the form below</li>
                        </ul>
                    </div>

                    <!-- Excel Format Example -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <small class="fw-bold">Expected Excel Format:</small>
                        </div>
                        <div class="card-body p-2">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>class_level_id</th>
                                        <th>subject_id</th>
                                        <th>topic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>Introduction to Algebra</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>Nouns and Pronouns</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>3</td>
                                        <td>Motion and Force</td>
                                    </tr>
                                </tbody>
                             </div>
                    </div>

                    <!-- Download Template Button -->
                    <div class="text-center mb-4">
                        <a href="{{ route('admin.topics.download-template') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-download me-2"></i>Download Excel Template
                        </a>
                    </div>

                    <!-- Upload Form -->
                    <div class="border-top pt-4">
                        <form method="POST" action="{{ route('admin.topics.bulk-upload.post') }}" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Select Excel/CSV File <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary">
                                        <i class="fas fa-file-excel"></i>
                                    </span>
                                    <input type="file" 
                                           name="excel_file" 
                                           class="form-control @error('excel_file') is-invalid @enderror" 
                                           accept=".xlsx,.xls,.csv"
                                           required>
                                    @error('excel_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">Allowed formats: .xlsx, .xls, .csv (Max: 5MB)</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100" id="uploadBtn">
                                <i class="fas fa-upload me-2"></i>Upload Topics
                            </button>
                        </form>
                    </div>

                    <!-- Error Display -->
                    @if(session('upload_errors'))
                        <div class="alert alert-danger mt-4">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Errors encountered:</h5>
                            <ul class="mb-0">
                                @foreach(session('upload_errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    const fileInput = document.querySelector('input[name="excel_file"]');
    
    if (!fileInput.files.length) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'No File Selected',
            text: 'Please select an Excel file to upload.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    const file = fileInput.files[0];
    const validExtensions = ['xlsx', 'xls', 'csv'];
    const extension = file.name.split('.').pop().toLowerCase();
    
    if (!validExtensions.includes(extension)) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Invalid File Type',
            text: 'Please upload an Excel (.xlsx, .xls) or CSV file.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    if (file.size > 5 * 1024 * 1024) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'File Too Large',
            text: 'File size should not exceed 5MB.',
            confirmButtonColor: '#6f42c1'
        });
        return false;
    }
    
    const btn = document.getElementById('uploadBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
});
</script>
@endsection