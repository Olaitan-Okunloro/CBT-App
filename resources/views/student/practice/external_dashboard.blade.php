@extends('layouts.app')

@section('title', 'Practice')

@section('content')

<div class="container">

    <h4 class="mb-4">📚 Practice Questions</h4>

    <form action="{{ route('student.practice.start') }}" method="GET">

        {{-- SUBJECTS --}}
        <div class="mb-4">
            <h5>Select Subject</h5>

            <div class="row g-2">
                @foreach($subjects as $subject)
                    <div class="col-md-3 col-6">
                        <button type="button"
                                class="subject-btn btn btn-outline-primary w-100"
                                data-id="{{ $subject->id }}">
                            {{ $subject->name }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- REQUIRED hidden field --}}
        <input type="hidden" name="subject_id" id="subject_id">

        {{-- TOPIC --}}
        <div class="mb-3">
            <select name="topic_id" id="topic" class="form-control" required>
                <option value="">Select Topic</option>
            </select>
        </div>

        <button class="btn btn-primary">
            🚀 Start Practice
        </button>

    </form>

</div>

@endsection


@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll('.subject-btn');

    buttons.forEach(btn => {

        btn.addEventListener('click', function () {

            let subjectId = this.dataset.id;

            // set hidden input
            document.getElementById('subject_id').value = subjectId;

            // highlight selected
            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // load topics
            let topicSelect = document.getElementById('topic');
            topicSelect.innerHTML = '<option>Loading...</option>';

            fetch('/get-topics/' + subjectId)
                .then(res => res.json())
                .then(data => {

                    let options = '<option value="">Select Topic</option>';

                    data.forEach(topic => {
                        options += `<option value="${topic.id}">${topic.topic}</option>`;
                    });

                    topicSelect.innerHTML = options;
                });

        });

    });

});
</script>
@endpush