@extends('layouts.app')

@section('title', 'Announcements')

@section('content')
<div class="container">

    <div class="row g-4">

        <div class="col-md-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
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
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Audience</label>

                            <select name="audience"
                                    class="form-control">
                                <option value="all">All Users</option>
                                <option value="student">Students</option>
                                <option value="teacher">Teachers</option>
                                <option value="school">Schools</option>
                                <option value="referrer">Referrers</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Message</label>

                            <textarea name="message"
                                      rows="5"
                                      class="form-control"></textarea>
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

                <div class="card-header bg-dark text-white">
                    Previous Announcements
                </div>

                <div class="card-body">

                    @foreach($rows as $row)

                        <div class="border-bottom mb-3 pb-3">

                            <h6>{{ $row->title }}</h6>

                            <small class="text-muted">
                                {{ ucfirst($row->audience) }}
                            </small>

                            <p class="mb-1 mt-2">
                                {{ $row->message }}
                            </p>

                        </div>

                    @endforeach

                    {{ $rows->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

</div>
@endsection