@extends('layouts.app')

@section('title', 'Result Remarks')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Teacher / Principal Remarks
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('school.results.remarks.save') }}">
                @csrf

                <div class="mb-3">
                    <label>Student</label>

                    <select name="student_id"
                            class="form-control">

                        @foreach($students as $student)

                            <option value="{{ $student->user_id }}">
                                {{ $student->name }} ({{ $student->registration_number }})
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Term</label>

                    <input type="text"
                           name="term"
                           class="form-control"
                           placeholder="First Term">
                </div>

                <div class="mb-3">
                    <label>Teacher Remark</label>

                    <textarea name="teacher_remark"
                              class="form-control"
                              rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label>Principal Remark</label>

                    <textarea name="principal_remark"
                              class="form-control"
                              rows="3"></textarea>
                </div>

                <button class="btn btn-success">
                    Save Remarks
                </button>

            </form>

        </div>

    </div>

</div>
@endsection