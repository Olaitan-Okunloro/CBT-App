@extends('layouts.app')

@section('title', 'Bulk Payment')

@section('content')
<div class="container">

    <form method="POST" action="{{ route('bulk.payment.create') }}">
        @csrf

        <div class="card shadow-sm">

            <div class="card-header bg-primary">
                Bulk Student Payment
            </div>

            <div class="card-body">

                @foreach($students as $student)

                    <div class="form-check mb-2">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="student_ids[]"
                            value="{{ $student->id }}"
                        >

                        <label class="form-check-label">
                            {{ $student->user->name }}
                            ({{ $student->registration_number }})
                        </label>
                    </div>

                @endforeach

                <button class="btn btn-success mt-3">
                    Generate Bulk Payment
                </button>

            </div>

        </div>

    </form>

</div>
@endsection