@extends('layouts.app')

@section('title', 'Approve Questions')

@section('content')
<div class="container">

    {{-- SUCCESS / ERROR --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    {{-- FILTER --}}
    <div class="card shadow-sm mb-3">

        <div class="card-header bg-primary text-white">
            Filter Questions
        </div>

        <div class="card-body">

            <form method="GET" class="row g-2">

                <div class="col-md-4">
                    <select name="teacher_id" class="form-control">
                        <option value="">All Teachers</option>
                        @foreach($teachers as $t)
                            <option value="{{ $t->id }}"
                                {{ request('teacher_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <select name="subject_id" class="form-control">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $s)
                            <option value="{{ $s->id }}"
                                {{ request('subject_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">
                        Filter
                    </button>
                </div>

            </form>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            Pending Questions
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('school.question.bulkApprove') }}">

                @csrf

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th width="50">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th>Question</th>
                            <th>Teacher</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($rows as $row)

                            <tr>

                                <td>
                                    <input type="checkbox"
                                           name="question_ids[]"
                                           value="{{ $row->id }}">
                                </td>

                                <td>
                                    {{ \Illuminate\Support\Str::limit($row->question_text, 100) }}
                                </td>

                                <td>
                                    {{ $row->user->name ?? 'N/A' }}
                                </td>

                                <td>
                                    <button type="button"
                                            class="btn btn-sm btn-info"
                                            onclick="showPreview({{ $row->id }})">
                                        View
                                    </button>
                                </td>

                            </tr>

                            {{-- HIDDEN PREVIEW DATA --}}
                            <div id="q-{{ $row->id }}" class="d-none">

    <div class="bg-white p-4 rounded border">

        <div class="text-center mb-4">

            <h5 class="mb-1">
                Question Preview
            </h5>

            <small class="text-muted">
                School Approval Portal
            </small>

        </div>

        <div class="mb-3">

            <strong>Question:</strong>

            <p class="mt-2 fs-5">
                {{ $row->question_text }}
            </p>

        </div>

        @if($row->question_type == 'objective')

            <div class="mt-4">

                <strong>Options:</strong>

                @foreach($row->options as $opt)

                    <div class="border rounded p-2 mb-2">

                        <strong>
                            {{ $opt->option_label }}.
                        </strong>

                        {{ $opt->option_text }}

                    </div>

                @endforeach

            </div>

        @endif

        <div class="mt-4 alert alert-success">

            <strong>Correct Answer:</strong>
            {{ $row->correct_answer }}

        </div>

    </div>

</div>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No pending questions found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <button class="btn btn-success mt-2">
                    Approve Selected
                </button>

            </form>

            {{ $rows->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>


{{-- CHECK ALL --}}
<script>
document.getElementById('checkAll').onclick = function () {
    document.querySelectorAll('input[name="question_ids[]"]')
        .forEach(cb => cb.checked = this.checked);
};
</script>


{{-- MODAL --}}
<div class="modal fade"
     id="previewModal"
     tabindex="-1">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    <i class="fas fa-file-alt me-2"></i>
                    Question Preview
                </h5>

                <button class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body bg-light p-4"
                 id="previewContent">

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>

            </div>

        </div>

    </div>

</div>

{{-- MODAL SCRIPT --}}
<script>
function showPreview(id)
{
    let content = document.getElementById('q-' + id).innerHTML;

    document.getElementById('previewContent').innerHTML = content;

    let modal = new bootstrap.Modal(
        document.getElementById('previewModal')
    );

    modal.show();
}
</script>

<style>
    #previewModal .modal-content{
        background:#fff !important;
        color:#000 !important;
    }

    #previewModal .modal-body,
    #previewModal .modal-title,
    #previewModal p,
    #previewModal div,
    #previewModal strong{
        color:#000 !important;
    }
</style>

@endsection