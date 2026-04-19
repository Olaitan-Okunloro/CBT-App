@extends('layouts.guest')

@section('title', 'Register - CBT App')
@section('auth-title', 'Create Account')
@section('auth-subtitle', 'Join our CBT platform today')

@section('auth-content')

<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Register As</label>
        <select class="form-select" name="user_type" id="user_type" required>
            <option value="">Select Type</option>
            <option value="student">Student</option>
            <option value="school">School</option>
            <option value="referrer">Referrer</option>
        </select>
    </div>

    {{-- Student Section --}}
    <div id="studentSection" style="display:none;">

        <div class="mb-3">
            <label class="form-label">Exam Type</label>
            <select name="exam_type" class="form-select">
                <option value="">Select Exam</option>
                <option value="UTME">UTME</option>
                <option value="WAEC">WAEC</option>
                <option value="NECO">NECO</option>
                <option value="GCE">GCE</option>
                <option value="NABTEB">NABTEB</option>
                <option value="GENERAL">GENERAL</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Referral Code (Optional)</label>
            <input type="text" name="student_referral_code" class="form-control">
        </div>

    </div>

    {{-- School Section --}}
    <div id="schoolSection" style="display:none;">

        <div class="mb-3">
            <label class="form-label">School Name</label>
            <input type="text" name="school_name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">School Address</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Referral Code (Optional)</label>
            <input type="text" name="school_referral_code" class="form-control">
        </div>

    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">Register</button>

</form>

<script>
document.getElementById('user_type').addEventListener('change', function () {

    document.getElementById('studentSection').style.display = 'none';
    document.getElementById('schoolSection').style.display = 'none';

    if (this.value === 'student') {
        document.getElementById('studentSection').style.display = 'block';
    }

    if (this.value === 'school') {
        document.getElementById('schoolSection').style.display = 'block';
    }
});
</script>

@endsection