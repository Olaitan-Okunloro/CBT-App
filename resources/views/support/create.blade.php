@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Create Support Ticket
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('support.store') }}">

                @csrf

                <div class="mb-3">

                    <label>Subject</label>

                    <input type="text"
                           name="subject"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Message</label>

                    <textarea name="message"
                              class="form-control"
                              rows="5"
                              required></textarea>

                </div>

                <button class="btn btn-primary">
                    Submit Ticket
                </button>

            </form>

        </div>

    </div>

</div>
@endsection