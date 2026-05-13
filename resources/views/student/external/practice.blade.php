@extends('layouts.app')

@section('title', 'Practice')

@section('content')

<div class="container">

<style>
.subject-btn.active{
    background-color:#0d6efd !important;
    color:white !important;
}
</style>
    
    <!-- 🔴 EXACT LOCATION FOR THE BLADE ALERT CODE 🔴 -->
    @php
    // 🔴 USE THIS DIRECT CHECK INSTEAD 🔴
    $isInternal = !is_null(auth()->user()->studentDetail->school_id);
    @endphp

    @if($isInternal)
        <div class="alert alert-info mb-4">
            <i class="fas fa-school me-2"></i> You are practicing from your school's question bank.
        </div>
    @else
        <div class="alert alert-warning mb-4">
            <i class="fas fa-globe me-2"></i> You are practicing from the public question bank.
        </div>
    @endif

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
        <!-- <div class="mb-3">
            <select name="topic_id" id="topic" required>
                <option value="">Select Topic</option>
            </select>
        </div> -->

        <div class="mb-3">
    <label for="topic" class="form-label fw-bold">
        📚 Topic
    </label>
    <select name="topic_id" id="topic" class="form-control" required style="background: white; color: black; border: 1px solid #ced4da; border-radius: 6px; padding: 8px 12px;">
        <option value="" style="background: white; color: black;">-- Select Topic --</option>
    </select>
    <div class="form-text">
        <i class="fas fa-info-circle"></i> Topics will load after subject selection
    </div>
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

document.querySelector('form').addEventListener('submit', function(e){

    let subject = document.getElementById('subject_id').value;
    let topic = document.getElementById('topic').value;

    if(!subject || !topic){

        e.preventDefault();

        alert('Please select subject and topic');

    }

});
</script>
@endpush