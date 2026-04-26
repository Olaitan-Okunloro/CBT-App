@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Manage Students
        </div><br><br>

        <form method="GET" class="row g-2 mb-3">

            <div class="col-md-5">

                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search name / reg no"
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-4">

                <select name="class_id"
                        class="form-control">

                    <option value="">
                        All Classes
                    </option>

                    @foreach($classes as $class)

                        <option value="{{ $class->id }}"
                            {{ request('class_id') == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <button class="btn btn-primary w-100">
                    Filter
                </button>

            </div>

        </form>
        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rows as $row)

                        <tr>

                            <td>
                                {{ $row->user->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $row->registration_number }}
                            </td>

                            <td>
                                {{ $row->classLevel->name ?? 'N/A' }}
                            </td>

                            <td>
                                @if(($row->user->status ?? 'active') == 'active')

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                    @else

                                    <span class="badge bg-danger">
                                        Suspended
                                    </span>

                                    @endif
                            </td>

                            <td>

                                <!-- <a href="{{ route('school.student.edit', $row->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a> -->

                                <form method="POST"
                                      action="{{ route('school.student.toggle', $row->id) }}"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-sm btn-info">
                                        Suspend
                                    </button>

                                </form>

                                <form method="POST"
                                      action="{{ route('school.student.delete', $row->id) }}"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-sm btn-danger">
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