@extends('layouts.app')

@section('title', 'Manage Results')

@section('content')
<div class="container">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            Result Release Management
        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Term</th>
                        <th>Status</th>
                        <th>Total Results</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($rows as $row)

                        <tr>

                            <td>{{ $row->term }}</td>

                            <td>{{ ucfirst($row->status) }}</td>

                            <td>{{ $row->total }}</td>

                            <td>

                                @if($row->status == 'pending')

                                    <form method="POST"
                                          action="{{ route('school.results.release') }}">
                                        @csrf

                                        <input type="hidden"
                                               name="term"
                                               value="{{ $row->term }}">

                                        <button class="btn btn-sm btn-success">
                                            Release
                                        </button>
                                    </form>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection