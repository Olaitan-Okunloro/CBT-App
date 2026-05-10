@extends('layouts.app')

@section('title', 'Create Questions')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Create Multiple Questions
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.questions.store') }}" id="questionForm">
                        @csrf

                        <!-- GLOBAL FIELDS (Declared Once) -->
                        <div class="card mb-4 border-left-primary">
                            <div class="card-header bg-light">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-cog me-2"></i>Exam Settings
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Exam Category <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-info text-white">
                                                <i class="fas fa-layer-group"></i>
                                            </span>
                                            <select name="exam_cat_id" class="form-select" id="exam_cat_id" required>
                                                <option value="">Select Exam Category</option>
                                                @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white">
                                                <i class="fas fa-book"></i>
                                            </span>
                                            <select name="subject_id" class="form-select" id="subject_id" required>
                                                <option value="">Select Subject</option>
                                                @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Topic <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-warning text-dark">
                                                <i class="fas fa-list-ul"></i>
                                            </span>
                                            <select name="topic_id" class="form-select" id="topic_id" required>
                                                <option value="">Select Subject First</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Questions Wrapper -->
                        <div id="questions-wrapper">
                            <!-- Question Block 0 (Initial) -->
                            <div class="question-block card mb-4 border-left-primary" data-index="0">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-primary">
                                        <i class="fas fa-question-circle me-2"></i>Question 1
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-danger remove-question" style="display: none;">
                                        <i class="fas fa-trash-alt me-1"></i>Remove
                                    </button>
                                </div>
                                <div class="card-body">
                                    <!-- Question Type -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Question Type <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-info text-white">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                            <select name="questions[0][question_type]" 
                                                    class="form-select question-type" 
                                                    onchange="toggleQuestionType(this)"
                                                    required>
                                                <option value="objective">Objective (Multiple Choice)</option>
                                                <option value="fill_in_the_gap">Fill in the Gap</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Question Text -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Question Text <span class="text-danger">*</span></label>
                                        <textarea name="questions[0][question_text]" 
                                                  class="form-control" 
                                                  rows="3" 
                                                  placeholder="Enter your question here..."
                                                  required></textarea>
                                    </div>

                                    <!-- Objective Section (Multiple Choice) -->
                                    <div class="objective-section">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Option A <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-primary text-white">A</span>
                                                    <input type="text" 
                                                           name="questions[0][option_a]" 
                                                           class="form-control option-input" 
                                                           placeholder="Enter option A">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Option B <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-success text-white">B</span>
                                                    <input type="text" 
                                                           name="questions[0][option_b]" 
                                                           class="form-control option-input" 
                                                           placeholder="Enter option B">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Option C <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-info text-white">C</span>
                                                    <input type="text" 
                                                           name="questions[0][option_c]" 
                                                           class="form-control option-input" 
                                                           placeholder="Enter option C">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Option D <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-warning text-dark">D</span>
                                                    <input type="text" 
                                                           name="questions[0][option_d]" 
                                                           class="form-control option-input" 
                                                           placeholder="Enter option D">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Correct Answer Dropdown -->
                                        <div class="mb-3 correct-answer-section">
                                            <label class="form-label fw-bold">Correct Answer <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                                <select name="questions[0][correct_answer]" 
                                                        class="form-select correct-answer-select" 
                                                        required>
                                                    <option value="">Select correct answer</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fill in the Gap Section -->
                                    <div class="fill-gap-section" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Expected Answer <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                                <input type="text" 
                                                       name="questions[0][expected_answer]" 
                                                       class="form-control expected-answer" 
                                                       placeholder="Enter the correct answer for the gap">
                                            </div>
                                            <small class="text-muted">Example: "Lagos" or "Nigeria"</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-success" onclick="addQuestion()">
                                <i class="fas fa-plus-circle me-2"></i>Add Another Question
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Save All Questions
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 4px solid #6f42c1;
    }
    .question-block {
        transition: all 0.3s ease;
    }
    .question-block:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .remove-question {
        transition: all 0.2s ease;
    }
    .remove-question:hover {
        transform: scale(1.05);
    }
    .input-group-text {
        font-weight: bold;
        min-width: 40px;
        justify-content: center;
    }
    textarea:focus, input:focus, select:focus {
        box-shadow: 0 0 0 0.2rem rgba(111,66,193,0.25);
        border-color: #6f42c1;
    }
    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
let questionCount = 1;

// Load topics based on selected subject
document.addEventListener('DOMContentLoaded', function() {
    const subjectSelect = document.getElementById('subject_id');
    const topicSelect = document.getElementById('topic_id');
    
    function loadTopics() {
        const subjectId = subjectSelect.value;
        
        if (!subjectId) {
            topicSelect.innerHTML = '<option value="">Select Subject First</option>';
            return;
        }
        
        topicSelect.innerHTML = '<option value="">Loading topics...</option>';
        
        fetch(`/get-topics/${subjectId}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Select Topic</option>';
                data.forEach(topic => {
                    options += `<option value="${topic.id}">${topic.name || topic.topic}</option>`;
                });
                topicSelect.innerHTML = options;
            })
            .catch(error => {
                console.error('Error loading topics:', error);
                topicSelect.innerHTML = '<option value="">Error loading topics</option>';
            });
    }
    
    subjectSelect.addEventListener('change', loadTopics);
    
    // Load topics if subject is pre-selected
    if (subjectSelect.value) {
        loadTopics();
    }
});

/**
 * Toggle question type (OBJECTIVE vs FILL GAP)
 */
function toggleQuestionType(selectElement) {
    const questionBlock = selectElement.closest('.question-block');
    applyQuestionTypeState(questionBlock, selectElement.value);
}

/**
 * Apply correct state to a question block
 */
function applyQuestionTypeState(block, type) {
    const objectiveSection = block.querySelector('.objective-section');
    const fillGapSection = block.querySelector('.fill-gap-section');

    const optionInputs = block.querySelectorAll('.option-input');
    const correctAnswer = block.querySelector('.correct-answer-select');
    const expectedAnswer = block.querySelector('.expected-answer');

    if (type === 'fill_in_the_gap') {
        objectiveSection.style.display = 'none';
        fillGapSection.style.display = 'block';
        optionInputs.forEach(input => {
            input.disabled = true;
            input.removeAttribute('required');
            input.value = '';
        });
        if (correctAnswer) {
            correctAnswer.disabled = true;
            correctAnswer.removeAttribute('required');
            correctAnswer.value = '';
        }
        if (expectedAnswer) {
            expectedAnswer.disabled = false;
            expectedAnswer.setAttribute('required', 'required');
        }
    } else {
        objectiveSection.style.display = 'block';
        fillGapSection.style.display = 'none';
        optionInputs.forEach(input => {
            input.disabled = false;
            input.setAttribute('required', 'required');
        });
        if (correctAnswer) {
            correctAnswer.disabled = false;
            correctAnswer.setAttribute('required', 'required');
        }
        if (expectedAnswer) {
            expectedAnswer.disabled = true;
            expectedAnswer.removeAttribute('required');
            expectedAnswer.value = '';
        }
    }
}

/**
 * Add new question
 */
function addQuestion() {
    let index = questionCount;

    let html = `
    <div class="question-block card mb-4 border-left-primary fade-in" data-index="${index}">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-question-circle me-2"></i>Question ${index + 1}
            </h5>
            <button type="button" class="btn btn-sm btn-danger remove-question">
                <i class="fas fa-trash-alt me-1"></i>Remove
            </button>
        </div>
        <div class="card-body">
            <!-- Question Type -->
            <div class="mb-3">
                <label class="form-label fw-bold">Question Type <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-info text-white">
                        <i class="fas fa-tag"></i>
                    </span>
                    <select name="questions[${index}][question_type]" class="form-select question-type" required>
                        <option value="objective">Objective (Multiple Choice)</option>
                        <option value="fill_in_the_gap">Fill in the Gap</option>
                    </select>
                </div>
            </div>

            <!-- Question Text -->
            <div class="mb-3">
                <label class="form-label fw-bold">Question Text <span class="text-danger">*</span></label>
                <textarea name="questions[${index}][question_text]" class="form-control" rows="3" placeholder="Enter your question here..." required></textarea>
            </div>

            <!-- OBJECTIVE SECTION -->
            <div class="objective-section">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Option A <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">A</span>
                            <input type="text" name="questions[${index}][option_a]" class="form-control option-input" placeholder="Enter option A">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Option B <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white">B</span>
                            <input type="text" name="questions[${index}][option_b]" class="form-control option-input" placeholder="Enter option B">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Option C <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-info text-white">C</span>
                            <input type="text" name="questions[${index}][option_c]" class="form-control option-input" placeholder="Enter option C">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Option D <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-dark">D</span>
                            <input type="text" name="questions[${index}][option_d]" class="form-control option-input" placeholder="Enter option D">
                        </div>
                    </div>
                </div>
                <div class="mb-3 correct-answer-section">
                    <label class="form-label fw-bold">Correct Answer <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white"><i class="fas fa-check-circle"></i></span>
                        <select name="questions[${index}][correct_answer]" class="form-select correct-answer-select" required>
                            <option value="">Select correct answer</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- FILL GAP SECTION -->
            <div class="fill-gap-section" style="display: none;">
                <div class="mb-3">
                    <label class="form-label fw-bold">Expected Answer <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white"><i class="fas fa-key"></i></span>
                        <input type="text" name="questions[${index}][expected_answer]" class="form-control expected-answer" placeholder="Enter the correct answer for the gap">
                    </div>
                    <small class="text-muted">Example: "Lagos" or "Nigeria"</small>
                </div>
            </div>
        </div>
    </div>
    `;

    document.getElementById('questions-wrapper').insertAdjacentHTML('beforeend', html);

    const newBlock = document.querySelector(`.question-block[data-index="${index}"]`);
    
    // Attach change event to new question type
    newBlock.querySelector('.question-type')
        .addEventListener('change', function() {
            applyQuestionTypeState(newBlock, this.value);
        });

    // Remove button event
    newBlock.querySelector('.remove-question')
        .addEventListener('click', function() {
            newBlock.remove();
            renumberQuestions();
        });

    // Initialize state
    applyQuestionTypeState(newBlock, 'objective');

    questionCount++;
}

/**
 * Renumber questions
 */
function renumberQuestions() {
    const blocks = document.querySelectorAll('.question-block');
    blocks.forEach((block, i) => {
        block.setAttribute('data-index', i);
        const inputs = block.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            const name = input.name;
            if (name) {
                input.name = name.replace(/questions\[\d+\]/, `questions[${i}]`);
            }
        });
        const title = block.querySelector('.card-header h5');
        if (title) title.innerHTML = `<i class="fas fa-question-circle me-2"></i>Question ${i + 1}`;
    });
    questionCount = blocks.length;
}

/**
 * Form submit
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('questionForm');
    const firstBlock = document.querySelector('.question-block');
    
    if (firstBlock) {
        const select = firstBlock.querySelector('.question-type');
        applyQuestionTypeState(firstBlock, select ? select.value : 'objective');
    }

    if (!form) return;

    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            form.reportValidity();
            return;
        }

        if (typeof Swal !== 'undefined') {
            e.preventDefault();
            Swal.fire({
                title: 'Save Questions?',
                icon: 'question',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
@endsection