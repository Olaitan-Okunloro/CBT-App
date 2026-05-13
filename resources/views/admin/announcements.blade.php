@extends('layouts.app')

@section('title', 'Announcements')

@section('content')
<div class="container">

    <div class="row g-4">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary">
                    Post Announcement
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.announcements.store') }}">

                        @csrf

                        <div class="mb-3">

                            <label>Title</label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Audience</label>

                            <select name="audience"
                                    class="form-control"
                                    required>

                                <option value="all">
                                    All Users
                                </option>

                                <option value="student">
                                    Students
                                </option>

                                <option value="teacher">
                                    Teachers
                                </option>

                                <option value="school">
                                    Schools
                                </option>

                                <option value="referrer">
                                    Referrers
                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label>Message</label>

                            <textarea name="message"
                                      rows="5"
                                      class="form-control"
                                      required></textarea>

                        </div>

                        <button class="btn btn-success">
                            Post Notice
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-md-7">

            <div class="card shadow-sm border-0">

                <div class="card-header">
                    Previous Announcements
                </div>

                <div class="card-body">

                    @forelse($rows as $row)

                        <div class="border-bottom mb-3 pb-3">

                            <h6 class="mb-1">
                                {{ $row->title }}
                            </h6>

                            <small class="badge bg-info text-dark">
                                {{ ucfirst($row->audience) }}
                            </small>

                            <small class="badge bg-{{ $row->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($row->status) }}
                            </small>

                            <p class="mb-2 mt-2">
                                {{ $row->message }}
                            </p>

                            <small class="text-muted d-block mb-2">
                                {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y h:i A') }}
                            </small>

                            <div>

                                <form method="POST"
                                      action="{{ route('admin.announcements.toggle', $row->id) }}"
                                      class="d-inline">

                                    @csrf

                                    <button class="btn btn-sm btn-warning">

                                        @if($row->status == 'active')
                                            Disable
                                        @else
                                            Activate
                                        @endif

                                    </button>

                                </form>

                                <form method="POST"
                                      action="{{ route('admin.announcements.delete', $row->id) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete announcement?')">

                                    @csrf

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    @empty

                        <div class="text-center text-muted py-4">
                            No announcements found
                        </div>

                    @endforelse

                    {{ $rows->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

</div>
@endsection