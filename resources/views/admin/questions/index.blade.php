@extends('layouts.app')

@section('title', 'Manage Questions')

@section('content')
<div class="container">

    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            Question Approval
        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rows as $row)

                        <tr>

                            <td>{{ Str::limit($row->question_text, 100) }}</td>

                            <td>

                                <span class="badge bg-{{ $row->status == 'approved' ? 'success' : 'warning' }}">
                                    {{ ucfirst($row->status) }}
                                </span>

                            </td>

                            <td>

                                @if($row->status == 'pending')

                                    <form method="POST"
                                          action="{{ route('admin.question.approve', $row->id) }}"
                                          class="d-inline">
                                        @csrf

                                        <button class="btn btn-success btn-sm">
                                            Approve
                                        </button>
                                    </form>

                                @endif

                                <form method="POST"
                                      action="{{ route('admin.question.delete', $row->id) }}"
                                      class="d-inline">
                                    @csrf

                                    <button class="btn btn-danger btn-sm">
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