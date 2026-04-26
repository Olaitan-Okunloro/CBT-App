@extends('layouts.app')

@section('title', 'Manage Teachers')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Manage Teachers
        </div><br><br>

        <form method="GET" class="row g-2 mb-3">

            <div class="col-md-9">

                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search teacher"
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-3">

                <button class="btn btn-primary w-100">
                    Search
                </button>

            </div>

        </form>

        <a href="{{ route('school.teachers') }}"
            class="btn btn-secondary">
            Reset
        </a>

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rows as $row)

                        <tr>

                            <td>
                                {{ $row->user->name }}
                            </td>

                            <td>
                                {{ $row->user->email }}
                            </td>

                            <td>
                                {{ $row->user->phone }}
                            </td>

                            <td>
                                {{ $row->user->status }}
                            </td>

                            <td>

                                <!-- <a href="{{ route('school.teacher.edit', $row->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a> -->

                                <form method="POST"
                                    action="{{ route('school.teacher.toggle', $row->user->id) }}"
                                    class="d-inline">

                                    @csrf

                                    <button type="submit"
                                            class="btn btn-sm btn-info">

                                        @if(($row->user->status ?? 'active') == 'active')

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Suspended
                                            </span>

                                        @endif

                                    </button>

                                </form>

                                <form method="POST"
                                      action="{{ route('school.teacher.delete', $row->id) }}"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete teacher?')">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            {{ $rows->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>
@endsection