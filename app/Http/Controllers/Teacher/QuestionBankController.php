<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\ExamCategory;

use Illuminate\Support\Facades\DB;

class QuestionBankController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();

        $categories = ExamCategory::all();

        $teacher = DB::table('teacher_details')
            ->where('user_id', auth()->id())
            ->first();

        if (!$teacher) {
            return back()->with(
                'error',
                'Teacher profile not found'
            );
        }

        $classes = SchoolClass::with('classLevel')
            ->where('school_id', $teacher->school_id)
            ->get()
            ->map(fn($row) => (object) [
                'id'   => $row->class_level_id,
                'name' => $row->classLevel->name ?? 'N/A'
            ]);

        return view(
            'teacher.questions.ai-generator',
            compact('subjects', 'classes', 'categories')
        );
    }

    public function generatePreview(Request $request)
    {
        $teacher = auth()->user()->teacherDetail;

        $request->validate([
            'subject_id'   => 'required',
            'exam_cat_id'   => 'required',
            'topic_ids'    => 'required|array|min:1',
            'topic_ids.*'  => 'required',
            'count'        => 'required|integer|min:1|max:50'
        ]);

        $questions = \App\Models\QuestionBank::where(
                'subject_id',
                $request->subject_id
            )
            ->where(
                'class_level_id',
                $teacher->class_id
            )
            ->whereIn(
                'topic_id',
                $request->topic_ids
            )
            ->inRandomOrder()
            ->limit($request->count)
            ->get();

        if ($questions->isEmpty()) {

            return response()->json([
                'success' => false,
                'message' => 'No questions found in bank'
            ]);
        }

        $formatted = [];

        foreach ($questions as $q) {

            $item = [
                'question_text'   => $q->question_text,
                'question_type'   => $q->question_type,
                'correct_answer'  => $q->correct_answer,
                'difficulty'      => $q->difficulty,
                'explanation'     => $q->explanation
            ];

            if ($q->question_type === 'objective') {

                $options =
                    \App\Models\Option::where(
                        'question_id',
                        $q->id
                    )->get();

                $opts = [];

                foreach ($options as $opt) {

                    $opts[$opt->option_label] =
                        $opt->option_text;
                }

                $item['options'] = $opts;

            } else {

                $item['expected_answer'] =
                    $q->correct_answer;
            }

            $formatted[] = $item;
        }

        return response()->json([
            'success'   => true,
            'questions' => $formatted,
            'count'     => count($formatted)
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'questions'    => 'required|json',
            'subject_id'   => 'required|exists:subjects,id',
            'exam_cat_id'   => 'required',
            'topic_ids' => 'required|array|min:1',
            'topic_ids.*' => 'required',
            'count' => 'required'
        ]);

        $questions = json_decode(
            $request->questions,
            true
        );

        if (!is_array($questions)) {
            return back()->with(
                'error',
                'Invalid question format'
            );
        }

        $questions = array_filter(
            $questions,
            function ($q) {
                return isset($q['question_text'])
                    && !empty($q['question_text']);
            }
        );

        $teacher = auth()->user()->teacherDetail;

        // --------------------------------------------------
        // DELETE OLD GENERATED QUESTIONS + OPTIONS
        // --------------------------------------------------

        if ($request->exam_cat_id == 1) {

            // GET OLD QUESTION IDS
            $oldQuestionIds = \App\Models\Question::where(
                    'created_by',
                    auth()->id()
                )
                ->where(
                    'exam_cat_id',
                    1
                )
                ->where(
                    'subject_id',
                    $request->subject_id
                )
                ->pluck('id');

            // DELETE OPTIONS FIRST
            \App\Models\TeacherOption::whereIn(
                'question_id',
                $oldQuestionIds
            )->delete();

            // DELETE QUESTIONS
            \App\Models\Question::whereIn(
                'id',
                $oldQuestionIds
            )->delete();
        }

        if (!$teacher) {
            return back()->with(
                'error',
                'Teacher profile not found'
            );
        }

        $savedCount = 0;

        foreach ($questions as $index => $q) {

            try {

                $topicId =
                    $request->topic_ids[
                        $index % count($request->topic_ids)
                    ];

                $exists = \App\Models\Question::where(
                        'question_text',
                        trim($q['question_text'])
                    )
                    ->where(
                        'subject_id',
                        $request->subject_id
                    )
                    ->where(
                        'topic_id',
                        $topicId
                    )
                    ->exists();

                if ($exists) {
                    continue;
                }

                $question =
                    \App\Models\Question::create([

                        'subject_id'      => $request->subject_id,
                        'topic_id'        => $topicId,
                        'class_level_id'  => $teacher->class_id ?? null,
                        'exam_cat_id'  => $request->exam_cat_id,
                        'school_id'       => $teacher->school_id,
                        'question_type'   => $q['question_type'],
                        'question_text'   => trim($q['question_text']),
                        'correct_answer'  =>
                            $q['correct_answer']
                            ?? $q['expected_answer']
                            ?? null,
                        'created_by'      => auth()->id(),
                        'source'          => 'internal',
                        'difficulty'      =>
                            $q['difficulty']
                            ?? 'medium',
                        'explanation'     =>
                            $q['explanation']
                            ?? null,
                            'status' => 'pending'
                    ]);

                if (
                    $q['question_type'] === 'objective'
                    && isset($q['options'])
                ) {

                    $optionsData = [];

                    foreach (
                        $q['options']
                        as $label => $text
                    ) {

                        $optionsData[] = [
                            'question_id'   => $question->id,
                            'option_label'  => $label,
                            'option_text'   => $text,
                            'created_at'    => now(),
                            'updated_at'    => now()
                        ];
                    }

                    \App\Models\TeacherOption::insert(
                        $optionsData
                    );
                }

                $savedCount++;

            } catch (\Exception $e) {

                \Log::error(
                    'Failed to save question: ' .
                    $e->getMessage()
                );
            }
        }

        if ($savedCount == 0) {
            return back()->with(
                'error',
                'No questions saved. Duplicate records found.'
            );
        }

        return back()->with(
            'success',
            $savedCount .
            ' questions saved successfully!'
        );
    }
}