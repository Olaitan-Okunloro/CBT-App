@extends('layouts.app')

@section('title', 'My Questions')

@section('content')
<div class="container">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            My Questions
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

                            <td>
                                {{ Str::limit($row->question_text, 80) }}
                            </td>

                            <td>

                                <span class="badge bg-{{ $row->status == 'approved' ? 'success' : 'warning' }}">
                                    {{ ucfirst($row->status) }}
                                </span>

                            </td>

                            <td>

                                <form method="POST"
                                      action="{{ route('teacher.question.delete', $row->id) }}">
                                    @csrf

                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete question?')">
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