<?php
// app/Http/Controllers/School/SchoolClassController.php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\School;
use App\Models\ClassLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SchoolClassController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->route('school.settings')
                ->with('error', 'Please complete your school profile first.');
        }
        
        // Add pagination (10 items per page)
        $assignedClasses = SchoolClass::where('school_id', $school->id)
            ->with('classLevel')
            ->orderBy('created_at', 'desc')
            ->paginate(5);  // Changed from get() to paginate()
        
        return view('school.classes.index', compact('assignedClasses'));
    }

    public function create()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->route('school.settings')
                ->with('error', 'Please complete your school profile first.');
        }
        
        // Get already assigned class IDs to exclude them
        $assignedClassIds = SchoolClass::where('school_id', $school->id)
            ->pluck('class_level_id')  // Changed from class_id
            ->toArray();
        
        $availableClasses = ClassLevel::whereNotIn('id', $assignedClassIds)->get();
        
        return view('school.classes.create', compact('availableClasses', 'school'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classes' => 'required|array|min:1',
            'classes.*.class_level_id' => 'required|exists:classes,id',  // Changed field name
        ]);

        $user = auth()->user();
        $school = $user->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->back()->with('error', 'School profile not found.');
        }

        DB::beginTransaction();
        
        $savedCount = 0;
        $errors = [];
        $duplicates = [];

        foreach ($request->classes as $index => $classData) {
            // Skip if class_level_id is empty or invalid
            if (empty($classData['class_level_id'])) {
                $errors[] = "Assignment #" . ($index + 1) . " has no class selected";
                continue;
            }
            
            // Verify class exists
            $classExists = ClassLevel::where('id', $classData['class_level_id'])->exists();
            if (!$classExists) {
                $errors[] = "Assignment #" . ($index + 1) . " references a class that doesn't exist";
                continue;
            }
            
            try {
                // Check for duplicate assignment
                $exists = SchoolClass::where('school_id', $school->id)
                    ->where('class_level_id', $classData['class_level_id'])  // Changed field name
                    ->exists();
                
                if ($exists) {
                    $class = ClassLevel::find($classData['class_level_id']);
                    $duplicates[] = $class->name ?? "Class #{$classData['class_level_id']}";
                    continue;
                }
                
                // Create the school class assignment
                SchoolClass::create([
                    'school_id' => $school->id,
                    'class_level_id' => $classData['class_level_id'],  // Changed field name
                ]);
                
                $savedCount++;
                
            } catch (\Exception $e) {
                Log::error('Failed to save school class assignment: ' . $e->getMessage());
                $errors[] = "Assignment #" . ($index + 1) . " failed: " . $e->getMessage();
            }
        }

        DB::commit();

        $message = '';
        
        if ($savedCount > 0) {
            $message .= "$savedCount class(es) assigned successfully! ";
        }
        
        if (!empty($duplicates)) {
            $message .= "Skipped (already assigned): " . implode(', ', $duplicates) . ". ";
        }
        
        if (!empty($errors)) {
            $message .= "Failed: " . implode('; ', $errors);
            return redirect()->route('classes.index')->with('warning', $message);
        }
        
        if ($savedCount === 0 && empty($duplicates)) {
            return redirect()->back()->with('error', 'No classes were assigned. Please try again.');
        }

        return redirect()->route('classes.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->back()->with('error', 'School profile not found.');
        }
        
        $assignment = SchoolClass::where('school_id', $school->id)
            ->where('id', $id)
            ->first();
        
        if (!$assignment) {
            return redirect()->back()->with('error', 'Class assignment not found.');
        }
        
        try {
            $assignment->delete();
            return redirect()->route('classes.index')
                ->with('success', 'Class unassigned successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete school class assignment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to unassign class.');
        }
    }
}