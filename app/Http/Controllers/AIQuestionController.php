<?php
// app/Http/Controllers/AIQuestionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Question;
use App\Models\Subject;
use App\Models\ClassLevel;
use App\Models\TeacherDetail;
use App\Models\TeacherOption;

class AIQuestionController extends Controller
{
    /**
     * Show AI question generator form
     */
    public function index()
    {
        $subjects = Subject::all();
        $classes = ClassLevel::all();
        return view('teacher.questions.ai-generator', compact('subjects','classes'));
    }

    /**
     * Generate questions using AI
     */
    public function generate(Request $request)
    {
        $request->validate([
            // 'topic' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'exam_type' => 'required|string|in:UTME,WAEC,NECO,GCE,SS1,SS2,SS3,JSS1,JSS2,JSS3,Primary1,Primary2,Primary3,Primary4,Primary5,Primary6',
            'count' => 'required|integer|min:1|max:50',
            'question_type' => 'required|string|in:objective,fill_in_the_gap,mixed',
            'difficulty' => 'required|string|in:easy,medium,hard',
            'options_count' => 'required|integer|min:2|max:5',
        ]);

        $apiKey = env('OPENAI_API_KEY');
        
        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'message' => 'OpenAI API Key is not configured. Please add OPENAI_API_KEY to your .env file.'
            ], 422);
        }

        try {
            // Build the prompt
            $subject = \App\Models\Subject::find($request->subject_id);

            if (!$subject) {
                return back()->with('error', 'Invalid subject selected');
            }

            $subjectName = $subject->name;

            $prompt = $this->buildPrompt($request, $subjectName);

            $topic = \App\Models\Topic::find($request->topic_id);
            $topicName = $topic->topics ?? '';

            $prompt .= "on topic '{$topicName}' ";
            
            // Call OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are an expert exam question generator. Generate high-quality educational questions in JSON format only. Do not include any additional text.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 4000,
            ]);
            
            if (!$response->successful()) {
                $error = $response->json();
                $errorMessage = $error['error']['message'] ?? 'Unknown error';
                
                return response()->json([
                    'success' => false,
                    'message' => 'OpenAI API Error: ' . $errorMessage
                ], 422);
            }
            
            $result = $response->json();
            $generatedText = $result['choices'][0]['message']['content'];
            $questions = $this->parseQuestions($generatedText);
            // dd($generatedText);
            
            if (empty($questions)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to parse generated questions. Please try again.'
                ], 422);
            }
            
            return response()->json([
                'success' => true,
                'questions' => $questions,
                'count' => count($questions)
            ]);
            
        } catch (\Exception $e) {
            Log::error('AI Question Generation Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error generating questions: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Build the prompt based on user parameters
     */
    private function buildPrompt($request, $subjectName)
    {
        $prompt = "Generate {$request->question_count} {$request->difficulty} difficulty ";
        $prompt .= "{$request->question_type} questions about '{$request->topic}' ";
        $prompt .= "for {$subjectName} subject ";
        $prompt .= "for {$request->exam_type} examination level.\n\n";
        
        if ($request->question_type === 'objective') {
            $prompt .= "Each question should have {$request->options_count} options (";
            $letters = ['A', 'B', 'C', 'D'];
            for ($i = 0; $i < $request->options_count; $i++) {
                $prompt .= $letters[$i];
                if ($i < $request->options_count - 1) $prompt .= ", ";
            }
            $prompt .= ").\n\n";
        }
        
        $prompt .= "Format the response as a JSON array with the following structure:\n";
        $prompt .= "[\n";
        $prompt .= "  {\n";
        $prompt .= "    \"question_text\": \"The question text\",\n";
        $prompt .= "    \"question_type\": \"objective or fill_in_the_gap\",\n";
        
        if ($request->question_type === 'objective' || $request->question_type === 'mixed') {
            $prompt .= "    \"options\": {\n";
            $letters = ['A', 'B', 'C', 'D'];
            for ($i = 0; $i < $request->options_count; $i++) {
                $prompt .= "      \"{$letters[$i]}\": \"Option {$letters[$i]} text\"";
                if ($i < $request->options_count - 1) $prompt .= ",";
                $prompt .= "\n";
            }
            $prompt .= "    },\n";
            $prompt .= "    \"correct_answer\": \"A\",\n";
        }
        
        if ($request->question_type === 'fill_in_the_gap' || $request->question_type === 'mixed') {
            if ($request->question_type === 'mixed') {
                $prompt .= "    \"expected_answer\": \"The correct answer\" (if fill_in_the_gap),\n";
            } else {
                $prompt .= "    \"expected_answer\": \"The correct answer\",\n";
            }
        }
        
        $prompt .= "    \"explanation\": \"Brief explanation of the answer\",\n";
        $prompt .= "    \"difficulty\": \"{$request->difficulty}\"\n";
        $prompt .= "  }\n";
        $prompt .= "]\n\n";
        $prompt .= "Generate only valid JSON. No other text.\n";
        
        return $prompt;
    }

    /**
     * Parse the AI response into an array of questions
     */
    private function parseQuestions($responseText)
    {
        try {
            // Clean the response text
            $cleanText = preg_replace('/```json\s*|\s*```/', '', $responseText);
            $cleanText = trim($cleanText);
            
            // Parse JSON
            $questions = json_decode($cleanText, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('JSON Parse Error: ' . json_last_error_msg());
                Log::error('Response Text: ' . $responseText);
                return [];
            }
            
            return $questions;
            
        } catch (\Exception $e) {
            Log::error('Parse Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Save generated questions to database
     */
    public function save(Request $request)
    {
        // dd($request->questions);
        $request->validate([
            'questions' => 'required|json',
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required'
        ]);

        $questions = json_decode($request->questions, true);

        // 🔥 FORCE ARRAY CHECK
        if (!is_array($questions)) {
            return back()->with('error', 'Invalid question format');
        }

        // 🔥 REMOVE EMPTY / INVALID ITEMS
        $questions = array_filter($questions, function ($q) {
            return isset($q['question_text']) && !empty($q['question_text']);
        });

        $teacher = auth()->user()->teacherDetail;

        if (!$teacher) {
            return back()->with('error', 'Teacher profile not found');
        }
        $savedCount = 0;

        // dd($questions);
        foreach ($questions as $q) {
            try {
                // Create question
                // 🚫 CHECK DUPLICATE FIRST
$exists = \App\Models\Question::where('question_text', trim($q['question_text']))
    ->where('subject_id', $request->subject_id)
    ->where('topic_id', $request->topic_id)
    ->exists();

if ($exists) {
    continue; // ⛔ Skip duplicate
}

                // ✅ CREATE ONLY IF NOT DUPLICATE
                $question = \App\Models\Question::create([
                    'subject_id' => $request->subject_id,
                    'topic_id' => $request->topic_id,
                    'class_level_id' => $teacher->class_id ?? null,
                    'school_id' => $teacher->school_id,
                    'question_type' => $q['question_type'],
                    'question_text' => trim($q['question_text']),
                    'correct_answer' => $q['correct_answer'] ?? $q['expected_answer'] ?? null,
                    'created_by' => auth()->id(),
                    'source' => 'internal',
                    'difficulty' => $q['difficulty'] ?? 'medium',
                    'explanation' => $q['explanation'] ?? null
                ]);

                // Save options if objective
                if ($q['question_type'] === 'objective' && isset($q['options'])) {
                    $optionsData = [];
                    foreach ($q['options'] as $label => $text) {
                        $optionsData[] = [
                            'question_id' => $question->id,
                            'option_label' => $label,
                            'option_text' => $text,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                    \App\Models\TeacherOption::insert($optionsData);
                }

                $savedCount++;

            } catch (\Exception $e) {
                Log::error('Failed to save AI question: ' . $e->getMessage());
                // dd($e->getMessage());
            }
        }

        if ($savedCount == 0) {
            return back()->with('error', 'No questions were saved because, duplicate questions detected!');
        }

        return redirect()->back()
            ->with('success', "$savedCount questions generated and saved successfully!");
    }
}