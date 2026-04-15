@extends('layouts.app')

@section('title', 'Student QR Code')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-qrcode me-2"></i>Student QR Code
                    </h4>
                </div>

                <div class="card-body text-center">

                    <h5 class="mb-3">{{ $student->name ?? 'Student' }}</h5>

                    <p class="text-muted">
                        Reg No: <strong>{{ $student->registration_number }}</strong>
                    </p>

                    <div class="mb-4">
                        {!! QrCode::size(250)->generate($student->registration_number) !!}
                    </div>

                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fas fa-print me-2"></i>Print QR Code
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection