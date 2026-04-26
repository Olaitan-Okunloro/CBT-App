@extends('layouts.app')

@section('title', 'Support')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Contact Support
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('support.store') }}">
                @csrf

                <div class="mb-3">
                    <label>Subject</label>
                    <input type="text"
                           name="subject"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Message</label>
                    <textarea name="message"
                              rows="5"
                              class="form-control"></textarea>
                </div>

                <button class="btn btn-primary">
                    Send Message
                </button>

            </form>

        </div>

    </div>

</div>
@endsection