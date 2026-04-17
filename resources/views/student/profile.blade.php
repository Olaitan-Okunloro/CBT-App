@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>
                        My Profile
                    </h4>
                </div>

                <div class="card-body text-center">
                    <img src="{{ asset('images/default-user.png') }}"
                         width="120"
                         class="rounded-circle mb-3 border">

                    <h4>{{ $student->user->name ?? 'N/A' }}</h4>

                    <p class="text-muted">
                        {{ $student->registration_number }}
                    </p>

                    <hr>

                    <div class="row text-start">
                        <div class="col-md-6 mb-3">
                            <strong>Email:</strong><br>
                            {{ $student->user->email ?? 'N/A' }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Class:</strong><br>
                            {{ $student->class->name ?? 'N/A' }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Guardian Email:</strong><br>
                            {{ $student->guardian_email ?? 'N/A' }}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Status:</strong><br>
                            Active Student
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection