@extends('layouts.app')

@section('title', 'Support Inbox')

@section('content')
<div class="container">

    <h3 class="mb-4 text-white">
        <i class="fas fa-headset me-2"></i>
        Support Inbox
    </h3>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="220">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rows as $row)

                            <tr>

                                <td>
                                    {{ \App\Models\User::find($row->user_id)->name ?? 'User' }}
                                </td>

                                <td>{{ $row->subject }}</td>

                                <td>{{ $row->message }}</td>

                                <td>

                                    <span class="badge bg-{{ $row->status == 'open' ? 'warning text-dark' : 'success' }}">
                                        {{ ucfirst($row->status) }}
                                    </span>

                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                                </td>

                                <td>

                                    @if($row->status == 'open')

                                        <form method="POST"
                                              action="{{ route('admin.support.resolve', $row->id) }}"
                                              class="d-inline">
                                            @csrf

                                            <button class="btn btn-sm btn-success">
                                                Resolve
                                            </button>
                                        </form>

                                    @endif

                                    <form method="POST"
                                          action="{{ route('admin.support.delete', $row->id) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this ticket?')">
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

            </div>

            {{ $rows->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>
@endsection