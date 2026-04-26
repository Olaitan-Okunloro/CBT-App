@extends('layouts.app')

@section('title', 'Promotion System')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Automatic Promotion
        </div>

        <div class="card-body text-center">

            <p class="mb-4">
                Promote students using Third Term results.
            </p>

            <form method="POST"
                  action="{{ route('school.promotion.run') }}">
                @csrf

                <button class="btn btn-success btn-lg"
                        onclick="return confirm('Run promotion now?')">
                    Promote Students
                </button>

            </form>

        </div>

    </div>

</div>
@endsection