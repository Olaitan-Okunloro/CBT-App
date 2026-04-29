@extends('layouts.app')

@section('title', 'Answer Sheet')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body bg-white p-5 text-dark" id="printArea">
                {{-- HEADER --}}
                <div class="text-center mb-4">
                    <h3>{{ $school->name }}</h3>
                    <p>{{ $school->address }}</p>
                    <h5>OBJECTIVE ANSWER SHEET</h5>
                </div>

                {{-- STUDENT INFO --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Name:</strong> __________________
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Reg No:</strong> __________
                    </div>
                </div>

                {{-- ANSWER TABLE --}}
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">A</th>
                            <th scope="col">B</th>
                            <th scope="col">C</th>
                            <th scope="col">D</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex gap-2">
            <button onclick="window.print()" class="btn btn-primary">
                Print
            </button>
        </div>
    </div>
@endsection