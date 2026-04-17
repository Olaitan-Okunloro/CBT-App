{{-- resources/views/results/checker.blade.php --}}

@extends('layouts.app')

@section('title', 'Check Result')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-search me-2"></i>
                        Online Result Checker
                    </h4>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('results.show') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-bold">Registration Number</label>
                            <input type="text"
                                   name="registration_number"
                                   class="form-control"
                                   placeholder="Enter Registration Number"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Session</label>
                            <input type="text"
                                   name="session"
                                   class="form-control"
                                   placeholder="e.g. 2025/2026"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Term</label>
                            <select name="term" class="form-select" required>
                                <option value="">Select Term</option>
                                <option>1st Term</option>
                                <option>2nd Term</option>
                                <option>3rd Term</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle me-2"></i>
                                Check Result
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection