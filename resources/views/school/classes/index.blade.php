<!-- resources/views/school/classes/index.blade.php -->
@extends('layouts.app')

@section('title', 'Assigned Classes')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-white">
                        <i class="fas fa-layer-group me-2"></i>Assigned Classes
                    </h4>
                    <a href="{{ route('classes.create') }}" class="btn btn-light">
                        <i class="fas fa-plus-circle me-2"></i>Assign New Class
                    </a>
                </div>
                <div class="card-body">
                    @if($assignedClasses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Class Name</th>
                                        <th>Date Assigned</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignedClasses as $index => $assignment)
                                    <tr>
                                        <td>{{ $assignedClasses->firstItem() + $index }}</td>
                                        <td>
                                            @if($assignment->classLevel)
                                                {{ $assignment->classLevel->name }}
                                            @else
                                                <span class="text-danger">Invalid Class (ID: {{ $assignment->class_level_id ?? 'NULL' }})</span>
                                            @endif
                                        </td>
                                        <td>{{ $assignment->created_at ? $assignment->created_at->format('d M, Y') : 'N/A' }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('classes.destroy', $assignment->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this class assignment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt me-1"></i>Remove
                                                </button>
                                            </form>
                                         </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            <!-- {{ $assignedClasses->links() }} -->
                            {{ $assignedClasses->links('vendor.pagination.custom') }}
                        </div>
                        
                        <!-- Showing info -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Showing {{ $assignedClasses->firstItem() }} to {{ $assignedClasses->lastItem() }} 
                                of {{ $assignedClasses->total() }} results
                            </small>
                        </div>
                        
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-layer-group fa-3x text-muted mb-3"></i>
                            <p>No classes assigned yet.</p>
                            <a href="{{ route('classes.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Assign First Class
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection