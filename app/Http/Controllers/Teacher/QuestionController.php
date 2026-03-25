<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use App\Models\Option;

class QuestionController extends Controller
{
    
    // create questions
    public function create()
    {
        $subjects = Subject::all();
        $classes = ClassLevel::all();
        return view('teacher.questions.create', compact('subjects','classes'));
    }

    // store 
    public function store(Request $request)
    {
        // dd($request->questions);
        // Validate the request
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'questions' => 'required|array|min:1',
            'questions.*.question_type' => 'required|in:objective,fill_in_the_gap',
            'questions.*.question_text' => 'required|string',
        ]);

        $teacher = auth()->user()->teacherDetail;
        $successCount = 0;
        $failedCount = 0;

        foreach($request->questions as $index => $q) {
            try {
                // Determine question type
                $questionType = $q['question_type'];
                
                // Validate based on question type
                if ($questionType === 'objective') {
                    // Validate objective fields
                    if (
                        !isset($q['option_a'], $q['option_b'], $q['option_c'], $q['option_d'], $q['correct_answer']) ||
                        trim($q['option_a']) === '' ||
                        trim($q['option_b']) === '' ||
                        trim($q['option_c']) === '' ||
                        trim($q['option_d']) === '' ||
                        trim($q['correct_answer']) === ''
                    )  
                    {
                        throw new \Exception("Question " . ($index + 1) . " is missing required fields");
                    }
                } elseif ($questionType === 'fill_in_the_gap') {
                    // Validate fill in the gap fields
                    if (!isset($q['expected_answer']) || trim($q['expected_answer']) === '') {
                        throw new \Exception("Question " . ($index + 1) . " is missing expected answer");
                    }
                }
                
                // Prepare base question data
                $questionData = [
                    'subject_id' => $request->subject_id,
                    'class_level_id' => $teacher->class_id ?? null,
                    'school_id' => $teacher->school_id,
                    'question_type' => $questionType,
                    'question_text' => $q['question_text'],
                    'created_by' => auth()->id(),
                    'source' => 'internal'
                ];
                
                // Handle different question types
                if ($questionType === 'objective') {
                    $questionData['correct_answer'] = $q['correct_answer'];
                    
                    $question = Question::create($questionData);
                    
                    // Insert options
                    Option::insert([
                        [
                            'question_id' => $question->id, 
                            'option_label' => 'A', 
                            'option_text' => $q['option_a']
                        ],
                        [
                            'question_id' => $question->id, 
                            'option_label' => 'B', 
                            'option_text' => $q['option_b']
                        ],
                        [
                            'question_id' => $question->id, 
                            'option_label' => 'C', 
                            'option_text' => $q['option_c']
                        ],
                        [
                            'question_id' => $question->id, 
                            'option_label' => 'D', 
                            'option_text' => $q['option_d']
                        ],
                    ]);
                    
                    $successCount++;
                    
                } elseif ($questionType === 'fill_in_the_gap') {

                    $expectedAnswer = $q['expected_answer'] ?? null;

                    if (!$expectedAnswer || trim($expectedAnswer) === '') {
                        throw new \Exception("Question " . ($index + 1) . " is missing expected answer");
                    }

                    $questionData['correct_answer'] = $expectedAnswer;

                    Question::create($questionData);

                    $successCount++;
                }
                
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        $message = "$successCount questions added successfully.";
        if ($failedCount > 0) {
            $message .= " $failedCount questions failed.";
        }

        if ($failedCount > 0 && $successCount === 0) {
            return back()->with('error', $message);
        }
        
        return back()->with('success', $message);
    }

}
