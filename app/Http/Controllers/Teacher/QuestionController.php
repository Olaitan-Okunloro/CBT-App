<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use App\Models\ExamCategory;
use App\Models\Option;
use App\Models\Topic;

use Barryvdh\DomPDF\Facade\Pdf;

class QuestionController extends Controller
{
    
    // create questions
    public function create()
    {
        $subjects = Subject::all();
        $classes = ClassLevel::all();
        $categories = ExamCategory::all();
        
        return view('teacher.questions.create', compact('subjects','classes', 'categories'));
    }

    public function getTopicsBySubject($subjectId)
    {
        $topics = \App\Models\Topic::where('subject_id', $subjectId)->get(['id', 'name']);
        return response()->json($topics);
    }

    // store 
    public function store(Request $request)
    {
        // dd($request->questions);
        // Validate the request
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'exam_cat_id'   => 'required',
            'topic_id'   => 'required',
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
                    'topic_id' => $request->topic_id,
                    'class_level_id' => $teacher->class_id ?? null,
                    'exam_cat_id'   => $request->exam_cat_id,
                    'school_id' => $teacher->school_id,
                    'question_type' => $questionType,
                    'question_text' => $q['question_text'],
                    'created_by' => auth()->id(),
                    'source' => 'internal',
                    'status' => 'pending'
                ];
                
                // Handle different question types
                if ($questionType === 'objective') {

                    // ✅ DELETE EXISTING QUESTION (PREVENT DUPLICATE)
                    $existingQuestion = Question::where('question_text', $q['question_text'])
                        ->where('subject_id', $request->subject_id)
                        ->where('school_id', $teacher->school_id)
                        ->first();

                    if ($existingQuestion) {
                        // delete options first (important)
                        Option::where('question_id', $existingQuestion->id)->delete();

                        // delete question
                        $existingQuestion->delete();
                    }

                    $questionData['correct_answer'] = $q['correct_answer'];
                    
                    $question = Question::create($questionData);
                    
                    // Insert options
                    Option::create([
                        'question_id' => $question->id,
                        'option_label' => 'A',
                        'option_text' => $q['option_a']
                    ]);

                    Option::create([
                        'question_id' => $question->id,
                        'option_label' => 'B',
                        'option_text' => $q['option_b']
                    ]);

                    Option::create([
                        'question_id' => $question->id,
                        'option_label' => 'C',
                        'option_text' => $q['option_c']
                    ]);

                    Option::create([
                        'question_id' => $question->id,
                        'option_label' => 'D',
                        'option_text' => $q['option_d']
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

    public function examPaper()
    {
        $teacher = auth()->user()->teacherDetail;

        $school = \App\Models\School::find(
            $teacher->school_id
        );

        $rows = \App\Models\Question::with([
                'options',
                'subject',
                'classLevel'
            ])
            ->where('created_by', auth()->id())
            ->where('status', 'approved')
            ->where('exam_cat_id', 1)
            ->latest()
            ->get();

        $subject =
            $rows->first()->subject->name
            ?? 'Subject';

        $class =
            $rows->first()->classLevel->name
            ?? 'Class';

        return view(
            'teacher.questions.paper',
            compact(
                'rows',
                'school',
                'teacher',
                'subject',
                'class'
            )
        );
    }

    public function downloadPdf()
    {
        $teacher = auth()->user()->teacherDetail;

        $school = \App\Models\School::find(
            $teacher->school_id
        );

        $rows = \App\Models\Question::with([
                'options',
                'subject',
                'classLevel'
            ])
            ->where('created_by', auth()->id())
            ->where('status', 'approved')
            ->where('exam_cat_id', 1)
            ->latest()
            ->get();

        $subject = $rows->first()->subject->name ?? 'Subject';
        $class   = $rows->first()->classLevel->name ?? 'Class';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'teacher.questions.paper-pdf',
            compact(
                'rows',
                'school',
                'teacher',
                'subject',
                'class'
            )
        );

        return $pdf->download('exam-paper.pdf');
    }

    public function answerSheet()
    {
        $teacher = auth()->user()->teacherDetail;

        $school = \App\Models\School::find(
            $teacher->school_id
        );

        $rows = \App\Models\Question::where(
                'created_by',
                auth()->id()
            )
            ->where('status', 'approved')
            ->where('exam_cat_id', 1)
            ->latest()
            ->get();

        return view(
            'teacher.questions.answer-sheet',
            compact('rows', 'school')
        );
    }

}
