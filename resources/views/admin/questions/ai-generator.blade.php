@extends('layouts.app')

@section('title', 'AI Question Generator')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary">
                    <h4 class="mb-0">
                        <i class="fas fa-robot me-2"></i>AI Question Generator
                    </h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Generate high-quality exam questions using AI. Provide the parameters below and let AI do the work!
                    </div>

                    <!-- Generation Form -->
                    <form method="POST" action="{{ route('admin.ai.generate') }}" id="generationForm">
                        @csrf
                        
                        <div class="row">
                            <div class="row">
                                <!-- Class -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Class <span class="text-danger">*</span></label>
                                    <select name="class_level_id" id="classSelect" class="form-control" required>
                                        <option value="">-- Select Class --</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Subject -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                                    <select name="subject_id" id="subjectSelect" class="form-control" required>
                                        <option value="">-- Select Subject --</option>
                                    </select>
                                </div>

                                <!-- Topic -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Topic <span class="text-danger">*</span></label>
                                    <select name="topic_id" id="topicSelect" class="form-control" required>
                                        <option value="">-- Select Topic --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Number of Questions <span class="text-danger">*</span></label>
                                <input type="number" name="question_count" class="form-control" 
                                       value="10" min="1" max="50" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Difficulty Level <span class="text-danger">*</span></label>
                                <select name="difficulty" class="form-select" required>
                                    <option value="easy">Easy</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Question Type <span class="text-danger">*</span></label>
                                <select name="question_type" class="form-select" id="questionType" required>
                                    <option value="objective">Objective (Multiple Choice)</option>
                                    <option value="fill_in_the_gap">Fill in the Gap</option>
                                    <option value="mixed">Mixed (Both Types)</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3" id="optionsCountDiv">
                                <label class="form-label fw-bold">Number of Options</label>
                                <select name="options_count" class="form-select">
                                    <option value="2">2 Options</option>
                                    <option value="3">3 Options</option>
                                    <option value="4" selected>4 Options</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>
                                    <input type="checkbox" name="explanation"> Include Explanation
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Additional Instructions (Optional)</label>
                            <textarea name="instructions" class="form-control" rows="2" 
                                      placeholder="e.g., Include diagrams, focus on calculations, emphasize key concepts..."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="generateBtn">
                                <i class="fas fa-magic me-2"></i>Generate Questions with AI
                            </button>
                        </div>
                    </form>

                    <!-- Loading Indicator -->
                    <div id="loadingIndicator" class="text-center mt-4" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Generating...</span>
                        </div>
                        <p class="mt-2">AI is generating your questions. This may take a few seconds...</p>
                    </div>

                    <!-- Generated Questions Preview -->
                    <div id="questionsPreview" style="display: none;">
                        <hr class="my-4">
                        <h5 class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Generated Questions
                            <span id="questionCount" class="badge bg-primary ms-2"></span>
                        </h5>
                        
                        <div id="questionsList" class="mb-3"></div>
                        
                        <form id="saveForm" method="POST" action="{{ route('admin.ai.save') }}">
                            @csrf
                            <input type="hidden" name="questions" id="savedQuestions">
                            <input type="hidden" name="class_level_id" id="classId">
                            <input type="hidden" name="subject_id" id="subjectId">
                            <input type="hidden" name="topic_id" id="topicId">
                            
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary" onclick="regenerate()">
                                    <i class="fas fa-sync-alt me-2"></i>Regenerate
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Save All Questions
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let generatedQuestions = [];

document.getElementById('generationForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Show loading
    document.getElementById('loadingIndicator').style.display = 'block';
    document.getElementById('generateBtn').disabled = true;
    document.getElementById('questionsPreview').style.display = 'none';
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('{{ route("admin.ai.generate") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            generatedQuestions = data.questions;
            displayQuestions(data.questions);
            document.getElementById('questionCount').textContent = data.count;
            document.getElementById('questionsPreview').style.display = 'block';
            
            toastr.success(`${data.count} questions generated successfully!`);
        } else {
            toastr.error(data.message || 'Failed to generate questions');
        }
    } catch (error) {
        console.error('Error:', error);
        toastr.error('An error occurred. Please try again.');
    } finally {
        document.getElementById('loadingIndicator').style.display = 'none';
        document.getElementById('generateBtn').disabled = false;
    }
});

function displayQuestions(questions) {
    const container = document.getElementById('questionsList');
    let html = '<div class="accordion" id="questionsAccordion">';
    
    questions.forEach((q, index) => {
        html += `
            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="accordion-button ${index > 0 ? 'collapsed' : ''}" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#collapse${index}">
                        <strong>Question ${index + 1}:</strong> 
                        <span class="ms-2 text-truncate">${q.question_text.substring(0, 100)}...</span>
                        <span class="badge bg-info ms-2">${q.question_type}</span>
                    </button>
                </h2>
                <div id="collapse${index}" class="accordion-collapse collapse ${index === 0 ? 'show' : ''}" 
                     data-bs-parent="#questionsAccordion">
                    <div class="accordion-body">
                        <div class="mb-2">
                            <strong>Question:</strong>
                            <p class="mt-1">${q.question_text}</p>
                        </div>`;
        
        if (q.question_type === 'objective' && q.options) {
            html += `<div class="mb-2">
                        <strong>Options:</strong>
                        <ul class="list-unstyled mt-1">`;
            for (let [label, text] of Object.entries(q.options)) {
                const isCorrect = q.correct_answer === label;
                html += `<li class="mb-1">
                            <span class="fw-bold">${label}:</span> ${text}
                            ${isCorrect ? '<span class="badge bg-success ms-2">Correct</span>' : ''}
                         </li>`;
            }
            html += `</ul></div>`;
        } else if (q.question_type === 'fill_in_the_gap') {
            html += `<div class="mb-2">
                        <strong>Expected Answer:</strong>
                        <p class="mt-1 text-success fw-bold">${q.expected_answer}</p>
                     </div>`;
        }
        
        if (q.explanation) {
            html += `<div class="mb-2">
                        <strong>Explanation:</strong>
                        <p class="mt-1 text-muted">${q.explanation}</p>
                     </div>`;
        }
        
        html += `
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" 
                                   id="include${index}" checked>
                            <label class="form-check-label" for="include${index}">
                                Include this question
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    
    html += '</div>';
    container.innerHTML = html;
}

function regenerate() {
    document.getElementById('generationForm').dispatchEvent(new Event('submit'));
}

// Handle save form
document.getElementById('saveForm').addEventListener('submit', function(e) {

    document.getElementById('classId').value = document.getElementById('classSelect').value;
    document.getElementById('subjectId').value = document.getElementById('subjectSelect').value;
    document.getElementById('topicId').value = document.getElementById('topicSelect').value;

    if (!generatedQuestions || generatedQuestions.length === 0) {
        e.preventDefault();
        toastr.error('No questions to save');
        return;
    }

    document.getElementById('savedQuestions').value = JSON.stringify(generatedQuestions);
});

// Toggle options count based on question type
document.getElementById('questionType').addEventListener('change', function() {
    const optionsDiv = document.getElementById('optionsCountDiv');
    if (this.value === 'objective') {
        optionsDiv.style.display = 'block';
    } else {
        optionsDiv.style.display = 'none';
    }
});

// Load Subjects based on Class
document.getElementById('classSelect').addEventListener('change', function () {
    let classId = this.value;

    console.log("Class ID:", classId); // DEBUG

    if (!classId) return;

    fetch(`{{ url('/get-subjects') }}/${classId}`)
        .then(res => res.json())
        .then(data => {
            console.log("Subjects:", data); // DEBUG

            let subjectSelect = document.getElementById('subjectSelect');
            subjectSelect.innerHTML = '<option value="">-- Select Subject --</option>';

            data.forEach(subject => {
                subjectSelect.innerHTML += `<option value="${subject.id}">${subject.name}</option>`;
            });

            document.getElementById('topicSelect').innerHTML = '<option value="">-- Select Topic --</option>';
        })
        .catch(err => {
            console.error("Error loading subjects:", err);
        });
});

// Load Topics based on Subject + Class
document.getElementById('subjectSelect').addEventListener('change', function () {
    let subjectId = this.value;
    let classId = document.getElementById('classSelect').value;

    fetch(`/get-topics/${classId}/${subjectId}`)
        .then(res => res.json())
        .then(data => {
            let topicSelect = document.getElementById('topicSelect');
            topicSelect.innerHTML = '<option value="">-- Select Topic --</option>';

            data.forEach(topic => {
                topicSelect.innerHTML += `<option value="${topic.id}">${topic.topic}</option>`;
            });
        });
});
</script>
@endsection