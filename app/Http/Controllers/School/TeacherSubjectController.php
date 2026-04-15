<?php
// app/Http/Controllers/School/TeacherSubjectController.php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\Subject;
use App\Models\SchoolClass;  // Changed from Classes to SchoolClass
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeacherSubjectController extends Controller
{
    /**
     * Display list of teacher subject assignments
     */
    public function index(Request $request)
    {
        $school = auth()->user()->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->route('school.settings')
                ->with('error', 'Please complete your school profile first.');
        }
        
        $query = TeacherSubject::where('school_id', $school->id)
            ->with(['teacher', 'subject', 'class']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('teacher', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('subject', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('class', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

            $paginator = $query->orderBy('created_at', 'desc')->paginate(10);

            $assignments = $paginator->getCollection()->groupBy(function ($item) {
                return $item->teacher_id . '-' . $item->subject_id;
            });
        
        return view('school.teacher-subjects.index', compact('assignments', 'paginator'));
    }

    /**
     * Show form to create new assignment
     */
    public function create()
    {
        $school = auth()->user()->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->route('school.settings')
                ->with('error', 'Please complete your school profile first.');
        }
        
        // Get teachers in this school
        $teachers = User::where('role', 'teacher')
            ->whereHas('teacherDetail', function($q) use ($school) {
                $q->where('school_id', $school->id);
            })
            ->get();
        
        // Get subjects
        $subjects = Subject::all();
        
        // Get classes assigned to this school (using SchoolClass model)
        $classes = SchoolClass::where('school_id', $school->id)
            ->with('classLevel')
            ->get();
        
        return view('school.teacher-subjects.create', compact('teachers', 'subjects', 'classes'));
    }

    /**
     * Store multiple assignments
     */
    public function store(Request $request)
    {
        $request->validate([
            'assignments' => 'required|array|min:1',
            'assignments.*.teacher_id' => 'required|exists:users,id',
            'assignments.*.subject_id' => 'required|exists:subjects,id',
            'assignments.*.class_id' => 'required|exists:school_classes,id',  // Changed to match your form
        ]);

        $school = auth()->user()->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->back()->with('error', 'School profile not found.');
        }

        DB::beginTransaction();
        
        $savedCount = 0;
        $errors = [];
        $duplicates = [];

        foreach ($request->assignments as $index => $assignment) {
            try {
                // Check for duplicate - use class_level_id
                $exists = TeacherSubject::where('school_id', $school->id)
                    ->where('teacher_id', $assignment['teacher_id'])
                    ->where('subject_id', $assignment['subject_id'])
                    ->where('class_id', $assignment['class_id']) // Map class_level_id to class_id
                    ->exists();
                
                if ($exists) {
                    $teacher = User::find($assignment['teacher_id']);
                    $subject = Subject::find($assignment['subject_id']);
                    $class = SchoolClass::find($assignment['class_id']);
                    $duplicates[] = "{$teacher->name} - {$subject->name} - " . ($class->classLevel->name ?? 'N/A');
                    continue;
                }
                
                // Create assignment - map class_level_id to class_id
                TeacherSubject::create([
                    'school_id' => $school->id,
                    'teacher_id' => $assignment['teacher_id'],
                    'subject_id' => $assignment['subject_id'],
                    'class_id' => $assignment['class_id'],  // Map here
                    'is_active' => true,
                ]);
                
                $savedCount++;
                
            } catch (\Exception $e) {
                Log::error('Failed to save teacher subject assignment: ' . $e->getMessage());
                $errors[] = "Assignment #" . ($index + 1) . " failed";
            }
        }

        DB::commit();

        $message = '';
        
        if ($savedCount > 0) {
            $message .= "$savedCount assignment(s) added successfully! ";
        }
        
        if (!empty($duplicates)) {
            $message .= "Skipped (already exist): " . implode(', ', $duplicates) . ". ";
        }
        
        if (!empty($errors)) {
            $message .= "Failed: " . implode('; ', $errors);
            return redirect()->route('teacher-subjects.index')->with('warning', $message);
        }

        return redirect()->route('teacher-subjects.index')->with('success', $message);
    }

    /**
     * Toggle assignment status (activate/deactivate)
     */
    public function toggle($id)
    {
        $school = auth()->user()->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->back()->with('error', 'School profile not found.');
        }
        
        $assignment = TeacherSubject::where('school_id', $school->id)
            ->where('id', $id)
            ->first();
        
        if (!$assignment) {
            return redirect()->back()->with('error', 'Assignment not found.');
        }
        
        $assignment->is_active = !$assignment->is_active;
        $assignment->save();
        
        $status = $assignment->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('teacher-subjects.index')
            ->with('success', "Assignment $status successfully.");
    }

    /**
     * Delete assignment
     */
    public function destroy($id)
    {
        $school = auth()->user()->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->back()->with('error', 'School profile not found.');
        }
        
        $assignment = TeacherSubject::where('school_id', $school->id)
            ->where('id', $id)
            ->first();
        
        if (!$assignment) {
            return redirect()->back()->with('error', 'Assignment not found.');
        }
        
        try {
            $assignment->delete();
            return redirect()->route('teacher-subjects.index')
                ->with('success', 'Assignment removed successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete teacher subject assignment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to remove assignment.');
        }
    }
}