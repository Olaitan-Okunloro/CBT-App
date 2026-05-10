@extends('layouts.app')

@section('title', 'Students')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="text-white">

            <i class="fas fa-users me-2"></i>

            Students

        </h3>

    </div>

    <div class="card shadow border-0">

        <div class="card-body">

            <!-- Search Form -->
            <form method="GET" action="{{ route('teacher.students') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search by student name or email..."
                                   value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('teacher.students') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i> Clear
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <small class="text-muted">
                            Total: {{ $students->total() }} student(s)
                        </small>
                    </div>
                </div>
            </form>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Class</th>

                            <th>Registered</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($students as $index => $student)

                            <tr>

                                <td>
                                    {{ $students->firstItem() + $index }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center">
                                        @if($student->profile_photo)
                                            <img src="{{ asset('storage/profile/' . $student->profile_photo) }}" 
                                                 class="rounded-circle me-2" 
                                                 width="35" height="35" 
                                                 style="object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                 style="width: 35px; height: 35px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif
                                        <strong>{{ $student->name }}</strong>
                                    </div>

                                </td>

                                <td>

                                    {{ $student->email }}

                                <td>

                                <td>

                                    @if($student->studentDetail && $student->studentDetail->schoolClass && $student->studentDetail->schoolClass->classLevel)
                                        <span class="badge bg-info">
                                            {{ $student->studentDetail->schoolClass->classLevel->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif

                                </td>

                                <td>

                                    {{ $student->created_at->format('d M Y') }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center py-5">

                                    <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>

                                    @if(request('search'))
                                        No students found matching "<strong>{{ request('search') }}</strong>"
                                    @else
                                        No students found.
                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} 
                    of {{ $students->total() }} results
                </div>
                <div>
                    {{ $students->links() }}
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')
<style>
    .table-responsive {
        border-radius: 10px;
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 5px 10px;
    }
    
    .input-group-text {
        border-radius: 10px 0 0 10px;
    }
    
    .input-group input, 
    .input-group button,
    .input-group a {
        border-radius: 0;
    }
    
    .input-group button:last-child {
        border-radius: 0 10px 10px 0;
    }
    
    .pagination {
        margin-bottom: 0;
    }
    
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start !important;
        }
    }
</style>
@endpush