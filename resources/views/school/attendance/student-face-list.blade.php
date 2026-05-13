{{-- resources/views/attendance/student-face-list.blade.php --}}

@extends('layouts.app')

@section('title', 'Student Face Registration')

@section('content')

<div class="container">

    <div class="card shadow-sm">
        <div class="card-header bg-primary">
            Student Face Registration
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Registration No</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($students as $student)

                        <tr>
                            <td>{{ $students->firstItem() + $loop->index }}</td>

                            <td>{{ $student->user->name ?? 'N/A' }}</td>

                            <td>{{ $student->registration_number }}</td>

                            <td>
                                <a href="{{ route('face.register', $student->id) }}"
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-user-check"></i>
                                    Register Face
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No students found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

@endsection