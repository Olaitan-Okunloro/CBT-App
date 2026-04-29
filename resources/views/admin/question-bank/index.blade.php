@extends('layouts.app')

@section('title', 'Question Bank')

@section('content')
<div class="container">

    {{-- FILTER CARD --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-primary text-white">
            Filter Question Bank
        </div>

        <div class="card-body">

            <form method="GET" class="row g-2">

                {{-- SUBJECT --}}
                <div class="col-md-3">

                    <select name="subject_id"
                            class="form-control">

                        <option value="">
                            All Subjects
                        </option>

                        @foreach($subjects as $s)

                            <option value="{{ $s->id }}"
                                {{ request('subject_id') == $s->id ? 'selected' : '' }}>

                                {{ $s->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- CLASS --}}
                <div class="col-md-3">

                    <select name="class_level_id"
                            class="form-control">

                        <option value="">
                            All Classes
                        </option>

                        @foreach($classes as $c)

                            <option value="{{ $c->id }}"
                                {{ request('class_level_id') == $c->id ? 'selected' : '' }}>

                                {{ $c->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- TOPIC --}}
                <div class="col-md-3">

                    <select name="topic_id"
                            class="form-control">

                        <option value="">
                            All Topics
                        </option>

                        @foreach($topics as $t)

                            <option value="{{ $t->id }}"
                                {{ request('topic_id') == $t->id ? 'selected' : '' }}>

                                {{ $t->topic }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- BUTTON --}}
                <div class="col-md-3">

                    <button type="submit"
                            class="btn btn-primary w-100">

                        Filter

                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- QUESTION TABLE --}}
    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">

            Question Bank
            ({{ $rows->total() }} questions)

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>Question</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Topic</th>
                            <th width="130">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($rows as $row)

                            <tr>

                                <td>

                                    {{ \Illuminate\Support\Str::limit($row->question_text, 80) }}

                                </td>

                                <td>
                                    {{ $row->subject->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $row->classLevel->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $row->topic->topic ?? '-' }}
                                </td>

                                <td>

                                    <button type="button"
                                            class="btn btn-sm btn-info"
                                            onclick="showPreview({{ $row->id }})">

                                        <i class="fas fa-eye"></i>
                                        View

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center">

                                    No questions found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $rows->appends(request()->query())->links('pagination::bootstrap-5') }}

            </div>

        </div>

    </div>

</div>



{{-- HIDDEN PREVIEW DATA --}}
@foreach($rows as $row)

<div id="qb-{{ $row->id }}"
     class="d-none">

    <div class="bg-white text-dark p-3">

        <h5 class="mb-3 text-primary">
            Question Preview
        </h5>

        <p>

            <strong>Question:</strong>

        </p>

        <p class="fs-5">

            {{ $row->question_text }}

        </p>

        @if($row->question_type == 'objective')

            <hr>

            <p>

                <strong>Options:</strong>

            </p>

            @foreach($row->options as $opt)

                <div class="border rounded p-2 mb-2">

                    <strong>
                        ({{ $opt->option_label }})
                    </strong>

                    {{ $opt->option_text }}

                </div>

            @endforeach

        @endif

        <hr>

        <small class="text-muted">

            Subject:
            {{ $row->subject->name ?? '-' }}

            |

            Class:
            {{ $row->classLevel->name ?? '-' }}

            |

            Topic:
            {{ $row->topic->topic ?? '-' }}

        </small>

    </div>

</div>

@endforeach



{{-- MODAL --}}
<div class="modal fade"
     id="qbModal"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">

                    Question Preview

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body bg-white text-dark"
                 id="qbContent">

            </div>

        </div>

    </div>

</div>



<script>

function showPreview(id)
{
    let source =
        document.getElementById(
            'qb-' + id
        );

    if (!source) {

        alert('Preview not found');

        return;
    }

    document.getElementById(
        'qbContent'
    ).innerHTML = source.innerHTML;

    let modal =
        new bootstrap.Modal(
            document.getElementById(
                'qbModal'
            )
        );

    modal.show();
}

</script>

@endsection