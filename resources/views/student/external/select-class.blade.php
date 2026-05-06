@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <h4>Select Your Class</h4>

        <form method="POST" action="{{ route('external.class.save') }}">
            @csrf

            <div class="mb-3">
                <label>Select Class</label>

                <select name="class_id" class="form-control" required>
                    <option value="">-- Choose Class --</option>

                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">
                Continue
            </button>
        </form>
    </div>
</div>
@endsection