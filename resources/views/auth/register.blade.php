<!-- resources/views/auth/register.blade.php -->
@extends('layouts.guest')

@section('title', 'Register - CBT App')
@section('auth-title', 'Create Account')
@section('auth-subtitle', 'Join our CBT platform today')

@section('auth-content')
<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf
    
    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               id="name" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" 
               id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- user type -->
    <div class="mb-3">
        <label for="user_type" class="form-label">User Type</label>

        <select class="form-select" id="user_type" name="user_type" required>
            <option value="">Select User Type</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="school">School</option>
        </select>
    </div>

    <div class="mb-3" id="teacherSchoolField" style="display:none;">
        <select class="form-select" name="teacher_school">
            <option value="">Select School</option>
            @foreach($schools as $school)
            <option value="{{ $school->id }}">
            {{ $school->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3" id="schoolFields" style="display:none">
        <input type="text" name="school_name" placeholder="School Name"><br><br>
        <input type="text" name="address" placeholder="School Address">
    </div><br>
        
    <!-- Phone -->
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
               id="phone" name="phone" value="{{ old('phone') }}" required>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Exam Type -->
    <div class="mb-3">
        <label for="exam_type" class="form-label">Exam Type</label>
        <select name="exam_type" id="exam_type" class="form-control">

        <option value="">Select Exam</option>
        <option value="UTME">UTME</option>
        <option value="WAEC">WAEC</option>
        <option value="NECO">NECO</option>
        <option value="GCE">GCE</option>
        <option value="NABTEB">NABTEB</option>
        <option value="GENERAL" id="general_option">GENERAL</option>
        </select>

    </div>

    <div class="mb-3" id="schoolField" style="display:none;">
        <label class="form-label">Select School</label>

        <select class="form-select" name="school_id" id="school_id">

        <option value="">Select School</option>

        @foreach($schools as $school)
        <option value="{{ $school->id }}">{{ $school->name }}</option>
        @endforeach

        </select>
    </div>
    
    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" 
               id="password" name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" 
               id="password_confirmation" name="password_confirmation" required>
    </div>
    
    <button type="submit" class="btn btn-primary w-100 py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        Register
    </button>
    
    <div class="auth-footer">
        Already have an account? <a href="{{ route('login') }}">Login here</a>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function(){

        let userType = document.getElementById('user_type');
        let examType = document.getElementById('exam_type');
        let generalOption = document.getElementById('general_option');
        let teacherSchool = document.getElementById('teacherSchoolField');

        userType.addEventListener('change', function(){

            if(this.value === 'teacher'){

                teacherSchool.style.display = 'block';

                examType.value = 'GENERAL';
                examType.setAttribute('readonly', true);
                examType.style.pointerEvents = 'none';

                generalOption.style.display = 'block';

            }

            if(this.value === 'student'){

                teacherSchool.style.display = 'none';

                generalOption.style.display = 'none';

                examType.removeAttribute('readonly');
                examType.style.pointerEvents = 'auto';

                if(examType.value === 'GENERAL'){
                examType.value = '';
                }

            }

        });

    });


    document.getElementById('user_type').addEventListener('change', function(){

        let schoolFields = document.getElementById('schoolFields');

        if(this.value === 'school'){

            schoolFields.style.display = 'block';

        }else{

            schoolFields.style.display = 'none';

        }

    });

</script>
@endsection