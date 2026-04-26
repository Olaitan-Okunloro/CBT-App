@extends('layouts.app')

@section('title', 'Users Management')

@section('content')
<div class="container">

    <h3 class="mb-4 text-white">
        <i class="fas fa-users-cog me-2"></i>
        Users Management
    </h3>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rows as $row)

                            <tr>

                                <td>{{ $row->name }}</td>

                                <td>{{ $row->email }}</td>

                                <td>{{ ucfirst($row->role) }}</td>

                                <td>
                                    <span class="badge bg-{{ $row->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $row->created_at->format('d M Y') }}
                                </td>

                                <td>

                                    <form method="POST"
                                        action="{{ route('admin.users.toggle', $row->id) }}"
                                        class="d-inline">
                                        @csrf

                                        <button class="btn btn-sm btn-primary">
                                            {{ $row->status == 'active' ? 'Suspend' : 'Activate' }}
                                        </button>
                                    </form>

                                    <form method="POST"
                                        action="{{ route('admin.users.delete', $row->id) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this user permanently?');">
                                        @csrf

                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-2"></i>
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{ $rows->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>
@endsection