<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
// use App\Models\Subject;
// use App\Models\ClassLevel;
// use App\Models\TeacherDetail;
// use App\Models\Option;

class QuestionBankController extends Controller
{
    public function generatePreview(Request $request)
    {
        $teacher = auth()->user()->teacherDetail;

        $request->validate([
            'subject_id' => 'required',
            'topic_id' => 'required',
            'count' => 'required|integer|min:1|max:50'
        ]);

        $questions = \App\Models\QuestionBank::where('subject_id', $request->subject_id)
            ->where('class_level_id', $teacher->class_id)
             ->where('topic_id', $request->topic_id)
            ->inRandomOrder()
            ->limit($request->count)
            ->get();

        if ($questions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No questions found in bank'
            ]);
        }

        // 🔥 FORMAT LIKE AI RESPONSE
        $formatted = [];

        foreach ($questions as $q) {

            $item = [
                'question_text' => $q->question_text,
                'question_type' => $q->question_type,
                'correct_answer' => $q->correct_answer,
                'difficulty' => $q->difficulty,
                'explanation' => $q->explanation
            ];

            if ($q->question_type === 'objective') {
                $options = \App\Models\Option::where('question_id', $q->id)->get();

                $opts = [];
                foreach ($options as $opt) {
                    $opts[$opt->option_label] = $opt->option_text;
                }

                $item['options'] = $opts;
            } else {
                $item['expected_answer'] = $q->correct_answer;
            }

            $formatted[] = $item;
        }

        return response()->json([
            'success' => true,
            'questions' => $formatted,
            'count' => count($formatted)
        ]);
    }
}
