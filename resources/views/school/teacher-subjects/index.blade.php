@extends('layouts.app')

@section('title', 'Teacher Subject Assignments')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Teacher Subject Assignments
                    </h4>
                    <a href="{{ route('school.teacher-subjects.create') }}" class="btn btn-light">
                        <i class="fas fa-plus-circle me-2"></i>New Assignment
                    </a>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('school.teacher-subjects.index') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search by teacher, subject or class..." 
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i>Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('teacher-subjects.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Clear
                                </a>
                            @endif
                        </div>
                    </form>

                    @if($assignments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Teacher</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th>Status</th>
                                        <th>Date Assigned</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignments as $group)
                                        @php
                                            $first = $group->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $first->teacher->name ?? 'N/A' }}</td>

                                            <td>{{ $first->subject->name ?? 'N/A' }}</td>

                                            <td>
                                                @foreach($group as $item)
                                                    <span class="badge bg-primary">
                                                        {{ $item->class->classLevel->name ?? 'N/A' }}
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td>
                                                @if($group->contains('is_active', true))
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>{{ $first->created_at->format('d M, Y') }}</td>

                                            <td>
                                                <div class="btn-group" role="group">
                                                    @foreach($group as $item)
                                                        <form method="POST" action="{{ route('school.teacher-subjects.destroy', $item->id) }}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Remove {{ $item->class->classLevel->name }}?')">
                                                                {{ $item->class->classLevel->name }}
                                                            </button>
                                                        </form>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $paginator->links('pagination::bootstrap-5') }}
                        </div>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} 
                                of {{ $paginator->total() }} results
                            </small>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                            <p>No teacher subject assignments found.</p>
                            <a href="{{ route('school.teacher-subjects.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Create First Assignment
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection