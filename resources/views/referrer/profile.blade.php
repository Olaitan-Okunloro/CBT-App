@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            Referrer Profile
        </div>

        <div class="text-center mb-4">

            @if($user->profile_photo)

                <img src="{{ asset('storage/profile/' . $user->profile_photo) }}"
                    class="rounded-circle shadow"
                    width="120"
                    height="120"
                    style="object-fit: cover;">

            @else

                <i class="fas fa-user-circle text-secondary"
                style="font-size: 120px;"></i>

            @endif

        </div>

        <p class="text-muted text-center">
            Update your profile photo
        </p>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('referrer.profile.update') }}" >
                @csrf

                <div class="mb-3">
                    <label>Full Name</label>
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
                    <label>Referral Code</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $user->referral_code }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Profile Photo</label>

                    <input type="file"
                        name="profile_photo"
                        class="form-control">
                </div>

                <button class="btn btn-success">
                    Update Profile
                </button>
            </form>
        </div>
    </div>
</div>
@endsection