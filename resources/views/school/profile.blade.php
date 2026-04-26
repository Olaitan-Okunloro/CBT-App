@extends('layouts.app')

@section('title', 'School Profile')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <i class="fas fa-school me-2"></i>
            School Profile
        </div>

        <div class="card-body">

            <div class="text-center mb-4">

                @if($user->profile_photo)

                    <img src="{{ asset('storage/profile/' . $user->profile_photo) }}"
                         width="120"
                         height="120"
                         class="rounded-circle shadow"
                         style="object-fit:cover;">

                @else

                    <i class="fas fa-school text-secondary"
                       style="font-size:120px;"></i>

                @endif

            </div>

            <form method="POST"
                  enctype="multipart/form-data"
                  action="{{ route('school.profile.update') }}">
                @csrf

                <div class="mb-3">
                    <label>School Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $user->name }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ $user->email }}">
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ $user->phone ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address"
                              rows="3"
                              class="form-control">{{ $school->address ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Logo / Photo</label>
                    <input type="file"
                           name="profile_photo"
                           class="form-control">
                </div>

                <button class="btn btn-primary">
                    Update Profile
                </button>

            </form>

        </div>

    </div>

</div>
@endsection