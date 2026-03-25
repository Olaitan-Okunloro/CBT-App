<!-- resources/views/teacher/questions/create.blade.php -->
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

                                    <div class="mb-3">
                                        <label style="color: white">Subject</label>
                                        <select name="subject_id" class="form-control">
                                            @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
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
                                            <!-- Option A -->
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

                                            <!-- Option B -->
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

                                            <!-- Option C -->
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

                                            <!-- Option D -->
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
        // Show/Hide
        objectiveSection.style.display = 'none';
        fillGapSection.style.display = 'block';

        // Disable objective inputs
        optionInputs.forEach(input => {
            input.disabled = true;
            input.removeAttribute('required');
            input.value = ''; // clean old values
        });

        if (correctAnswer) {
            correctAnswer.disabled = true;
            correctAnswer.removeAttribute('required');
            correctAnswer.value = '';
        }

        // Enable expected answer
        if (expectedAnswer) {
            expectedAnswer.disabled = false;
            expectedAnswer.setAttribute('required', 'required');
        }

    } else {
        // Show/Hide
        objectiveSection.style.display = 'block';
        fillGapSection.style.display = 'none';

        // Enable objective inputs
        optionInputs.forEach(input => {
            input.disabled = false;
            input.setAttribute('required', 'required');
        });

        if (correctAnswer) {
            correctAnswer.disabled = false;
            correctAnswer.setAttribute('required', 'required');
        }

        // Disable expected answer
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
        <div class="card-header d-flex justify-content-between">
            <h5>Question ${index + 1}</h5>
            <button type="button" class="btn btn-danger btn-sm remove-question">Remove</button>
        </div>

        <div class="card-body">

            <select name="questions[${index}][question_type]" 
                    class="form-select question-type" required>
                <option value="objective">Objective</option>
                <option value="fill_in_the_gap">Fill in the Gap</option>
            </select>

            <textarea name="questions[${index}][question_text]" 
                      class="form-control mt-2" required></textarea>

            <!-- OBJECTIVE -->
            <div class="objective-section mt-3">
                <input type="text" name="questions[${index}][option_a]" class="form-control option-input mb-2" placeholder="Option A" required>
                <input type="text" name="questions[${index}][option_b]" class="form-control option-input mb-2" placeholder="Option B" required>
                <input type="text" name="questions[${index}][option_c]" class="form-control option-input mb-2" placeholder="Option C" required>
                <input type="text" name="questions[${index}][option_d]" class="form-control option-input mb-2" placeholder="Option D" required>

                <select name="questions[${index}][correct_answer]" class="form-select correct-answer-select" required>
                    <option value="">Correct Answer</option>
                    <option>A</option><option>B</option><option>C</option><option>D</option>
                </select>
            </div>

            <!-- GAP -->
            <div class="fill-gap-section mt-3" style="display:none;">
                <input type="text" name="questions[${index}][expected_answer]" 
                       class="form-control expected-answer" 
                       placeholder="Expected Answer">
            </div>
        </div>
    </div>
    `;

    document.getElementById('questions-wrapper').insertAdjacentHTML('beforeend', html);

    const newBlock = document.querySelector(`.question-block[data-index="${index}"]`);

    // Attach event
    newBlock.querySelector('.question-type')
        .addEventListener('change', function () {
            applyQuestionTypeState(newBlock, this.value);
        });

    // Remove button
    newBlock.querySelector('.remove-question')
        .addEventListener('click', function () {
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

        const title = block.querySelector('h5');
        if (title) title.textContent = `Question ${i + 1}`;
    });

    questionCount = blocks.length;
}

/**
 * Form submit (SAFE)
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('questionForm');

    if (!form) return;

    form.addEventListener('submit', function (e) {

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

    // Initialize FIRST question properly
    document.querySelectorAll('.question-block').forEach(block => {
        const select = block.querySelector('.question-type');
        applyQuestionTypeState(block, select.value);
    });
});
</script>
@endsection