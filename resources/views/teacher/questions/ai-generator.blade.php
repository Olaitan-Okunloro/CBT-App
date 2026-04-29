@extends('layouts.app')

@section('title', 'AI Question Generator')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-robot me-2"></i>
                        AI Question Generator
                    </h4>
                </div>

                <div class="card-body">

                    <div class="alert alert-info">
                        Generate quality questions using AI.
                        Multiple topics supported.
                    </div>

                    <form id="generationForm">

                        @csrf
                        <div class="mb-3">
                            <label>Exam Category</label>

                            <select name="exam_cat_id"
                                    id="examSelect"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Select Exam Category
                                </option>

                                @foreach($categories as $cat)

                                    <option value="{{ $cat->id }}">
                                        {{ $cat->category }}
                                    </option>

                                @endforeach

                            </select>

                        </div>
                        <div class="mb-3">
                            <label>Class</label>

                            <select name="class_level_id"
                                    id="classSelect"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Select Class
                                </option>

                                @foreach($classes as $class)

                                    <option value="{{ $class->id }}">
                                        {{ $class->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">

                            <label>Subject</label>

                            <select name="subject_id"
                                    id="subjectSelect"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Select Subject
                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label>Topics</label>

                            <select id="topicSelect"
                                    class="form-control">

                                <option value="">
                                    Select Topic
                                </option>

                            </select>

                        </div>

                        <div id="selectedTopics"
                             class="mb-3"></div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>Number of Questions</label>

                                <input type="number"
                                       name="count"
                                       class="form-control"
                                       
                                       min="1"
                                       max="50">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Difficulty</label>

                                <select name="difficulty"
                                        class="form-control">

                                    <option value="easy">
                                        Easy
                                    </option>

                                    <option value="medium" selected>
                                        Medium
                                    </option>

                                    <option value="hard">
                                        Hard
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Question Type</label>

                                <select name="question_type"
                                        id="questionType"
                                        class="form-control">

                                    <option value="objective">
                                        Objective
                                    </option>

                                    <option value="fill_in_the_gap">
                                        Fill in the Gap
                                    </option>

                                    <option value="mixed">
                                        Mixed
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="mb-3"
                             id="optionsCountDiv">

                            <label>Options Count</label>

                            <select name="options_count"
                                    class="form-control">

                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4" selected>4</option>

                            </select>

                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100"
                                id="generateBtn">

                            Generate Questions

                        </button>

                    </form>

                    <div id="loadingIndicator"
                         class="text-center mt-3"
                         style="display:none;">

                        Generating...

                    </div>

                </div>

            </div>

            {{-- PREVIEW --}}
            <div id="questionsPreview"
                 class="card shadow-sm mt-4"
                 style="display:none;">

                <div class="card-header bg-success text-white">

                    Generated Questions
                    (<span id="questionCount">0</span>)

                </div>

                <div class="card-body">

                    <div id="questionsList"></div>

                    <form method="POST"
                          action="{{ route('teacher.question.save') }}"
                          id="saveForm">

                        @csrf

                        <input type="hidden"
                               name="exam_cat_id"
                               id="savedCatId">

                        <input type="hidden"
                               name="questions"
                               id="savedQuestions">

                        <input type="hidden"
                               name="subject_id"
                               id="savedSubjectId">

                        <input type="hidden"
                            name="count"
                            id="savedCount">       

                        <div id="hiddenTopicsBox"></div>

                        <button class="btn btn-success mt-3">
                            Save To Question Bank
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
<script>

let selectedTopics = [];
let generatedQuestions = [];

/* =====================================
   LOAD SUBJECTS WHEN CLASS CHANGES
===================================== */
document.getElementById('classSelect')
.addEventListener('change', function () {

    let classId = this.value;

    if (!classId) return;

    fetch("{{ url('/get-subjects') }}/" + classId)

    .then(response => response.json())

    .then(data => {

        let subjectSelect =
            document.getElementById('subjectSelect');

        subjectSelect.innerHTML =
            '<option value="">Select Subject</option>';

        data.forEach(sub => {

            subjectSelect.innerHTML += `
                <option value="${sub.id}">
                    ${sub.name}
                </option>
            `;
        });

        document.getElementById('topicSelect').innerHTML =
            '<option value="">Select Topic</option>';

        document.getElementById('selectedTopics').innerHTML =
            '';

        selectedTopics = [];
    })

    .catch(error => {

        console.error(error);
        alert('Failed to load subjects');
    });

});


/* =====================================
   LOAD TOPICS WHEN SUBJECT CHANGES
===================================== */
document.getElementById('subjectSelect')
.addEventListener('change', function () {

    let subjectId = this.value;

    if (!subjectId) return;

    fetch("{{ url('/get-topics') }}/" + subjectId)

    .then(response => response.json())

    .then(data => {

        let topicSelect =
            document.getElementById('topicSelect');

        topicSelect.innerHTML =
            '<option value="">Select Topic</option>';

        data.forEach(topic => {

            topicSelect.innerHTML += `
                <option value="${topic.id}">
                    ${topic.topic}
                </option>
            `;
        });

        document.getElementById('selectedTopics').innerHTML =
            '';

        selectedTopics = [];
    })

    .catch(error => {

        console.error(error);
        alert('Failed to load topics');
    });

});


/* =====================================
   SELECT MULTIPLE TOPICS
===================================== */
document.getElementById('topicSelect')
.addEventListener('change', function () {

    let topicId = this.value;

    let topicName =
        this.options[this.selectedIndex].text;

    if (!topicId) return;

    if (selectedTopics.includes(topicId)) {

        this.value = '';
        return;
    }

    selectedTopics.push(topicId);

    let box =
        document.getElementById('selectedTopics');

    box.innerHTML += `
        <span class="badge bg-primary me-2 mb-2 p-2">

            ${topicName}

            <a href="#"
               onclick="removeTopic('${topicId}', this)"
               class="text-white text-decoration-none ms-2 fw-bold">
               ×
            </a>

        </span>
    `;

    this.value = '';
});


/* =====================================
   REMOVE TOPIC
===================================== */
function removeTopic(id, element)
{
    selectedTopics =
        selectedTopics.filter(
            item => item != id
        );

    element.parentElement.remove();
}


/* =====================================
   TOGGLE OPTIONS COUNT
===================================== */
document.getElementById('questionType')
.addEventListener('change', function () {

    let box =
        document.getElementById('optionsCountDiv');

    box.style.display =
        this.value === 'objective'
        ? 'block'
        : 'none';
});


/* =====================================
   GENERATE QUESTIONS
===================================== */
document.getElementById('generationForm')
.addEventListener('submit', async function (e) {

    e.preventDefault();

    if (selectedTopics.length === 0) {
        alert('Please select at least one topic');
        return;
    }

    try {

        document.getElementById('loadingIndicator')
            .style.display = 'block';

        

        const formData = new FormData(this);

formData.set(
    'count',
    document.querySelector('[name="count"]').value
);

        selectedTopics.forEach(id => {
            formData.append('topic_ids[]', id);
        });

        const response = await fetch(
            "{{ route('teacher.bank.preview') }}",
            {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN":
                    document.querySelector(
                        'input[name="_token"]'
                    ).value
                },
                body: formData
            }
        );

        const data = await response.json();

        document.getElementById('loadingIndicator')
            .style.display = 'none';

        if (!data.success) {
            alert(data.message);
            return;
        }

        generatedQuestions = data.questions;

        document.getElementById('questionCount')
            .innerText = data.count;

        let html = '';

        data.questions.forEach((q, index) => {

            html += `
                <div class="border rounded p-3 mb-3">

                    <strong>
                        Question ${index + 1}
                    </strong>

                    <p class="mt-2">
                        ${q.question_text}
                    </p>

                </div>
            `;
        });

        document.getElementById('questionsList')
            .innerHTML = html;

        document.getElementById('questionsPreview')
            .style.display = 'block';

    } catch (error) {

        console.error(error);

        document.getElementById('loadingIndicator')
            .style.display = 'none';

        alert('Failed to generate questions');
    }

});


/* =====================================
   SAVE QUESTIONS
===================================== */
document.getElementById('saveForm')
.addEventListener('submit', function () {

    document.getElementById('savedCatId').value =
        document.getElementById('examSelect').value;

    document.getElementById('savedQuestions').value =
        JSON.stringify(generatedQuestions);

    document.getElementById('savedSubjectId').value =
        document.getElementById('subjectSelect').value;

        document.getElementById('savedCount').value =
document.querySelector('[name="count"]').value;

    let hiddenBox =
        document.getElementById('hiddenTopicsBox');

    hiddenBox.innerHTML = '';

    selectedTopics.forEach(id => {

        hiddenBox.innerHTML += `
            <input type="hidden"
                   name="topic_ids[]"
                   value="${id}">
        `;
    });

});

document.getElementById('saveForm')
.addEventListener('submit', function(){

    document.getElementById('savedCatId').value =
        document.getElementById('examSelect').value;

    document.getElementById('savedQuestions').value =
        JSON.stringify(generatedQuestions);

    document.getElementById('savedSubjectId').value =
        document.getElementById('subjectSelect').value;

    let hiddenBox =
        document.getElementById('hiddenTopicsBox');

    hiddenBox.innerHTML = '';

    selectedTopics.forEach(id => {

        hiddenBox.innerHTML += `
            <input type="hidden"
                   name="topic_ids[]"
                   value="${id}">
        `;
    });

});

</script>
@endsection