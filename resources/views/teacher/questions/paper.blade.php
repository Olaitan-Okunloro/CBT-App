@extends('layouts.app')

@section('title', 'Exam Paper')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body bg-white text-dark p-5" id="printArea">
                {{-- HEADER --}}
                <div class="text-center mb-4">
                    @if(!empty($school->logo))
                        <img src="{{ asset('storage/logo/' . $school->logo) }}" height="70" alt="School Logo">
                    @endif

                    <h3 class="mb-1 mt-2">{{ $school->name }}</h3>
                    <p class="mb-1">{{ $school->address }}</p>
                    <h5 class="mt-2">END OF TERM EXAMINATION</h5>
                </div>

                {{-- META --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Subject:</strong> {{ $subject }}
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Class:</strong> {{ $class }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Session:</strong> {{ date('Y') }}/{{ date('Y') + 1 }}
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Time:</strong> 1 Hour
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <strong>Name:</strong> __________________
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>Reg No:</strong> __________
                    </div>
                </div>

                {{-- INSTRUCTIONS --}}
                <div class="border p-3 mb-4">
                    <strong>Instructions:</strong><br>
                    Answer all questions.<br>
                    Choose the correct option where applicable.<br>
                    Write neatly and clearly.
                </div>

                {{-- QUESTIONS --}}
                @foreach($rows as $index => $row)
                    <div class="mb-4">
                        <p>
                            <strong>{{ $index + 1 }}.</strong>
                            {{ $row->question_text }}
                        </p>

                        @if($row->question_type == 'objective')
                            @foreach($row->options as $opt)
                                <div class="ms-4 mb-1">
                                    ({{ $opt->option_label }})
                                    {{ $opt->option_text }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach

                {{-- SIGNATURE --}}
                <div class="text-end mt-5">
                    @if(auth()->user()->signature)
                        <img src="{{ asset('storage/signatures/' . auth()->user()->signature) }}" height="55" alt="Teacher Signature">
                    @endif
                    <div>__________________</div>
                    <div>Class Teacher</div>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex gap-2">
            <button onclick="window.print()" class="btn btn-primary">
                Print Paper
            </button>

            <a href="{{ route('teacher.exam.paper.pdf') }}" class="btn btn-success">
                Download PDF
            </a>

            <a href="{{ route('teacher.answer.sheet') }}" class="btn btn-dark">
                Answer Sheet
            </a>
        </div>
    </div>
@endsection