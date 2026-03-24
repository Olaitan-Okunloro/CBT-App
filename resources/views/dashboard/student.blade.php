<!-- resources/views/dashboard/student.blade.php -->
@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0" style="color:white"><i class="fas fa-school me-2" style="color:white"></i>Student Dashboard</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Available Exams</h5>
                                <p class="card-text display-4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Completed Exams</h5>
                                <p class="card-text display-4">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-3">
                    <h5>Welcome, {{ auth()->user()->name }}!</h5>
                    <p>Registration Number: {{ auth()->user()->studentDetail->registration_number ?? 'N/A' }}</p>
                    <p class="mb-0">Email: {{ auth()->user()->email }}</p><br>
                    @php
                        $student = auth()->user()->studentDetail;
                    @endphp

                    @if($student && $student->payment_expiry)
                        <p>
                            Your subscription expires in: 
                            {{ $student->payment_expiry->diffForHumans() }}
                        </p>
                    @else
                        <p class="text-warning">
                            Subscription not active.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection