<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\SchoolDetails;
use App\Models\User;
use App\Models\TeacherDetail;
use App\Models\StudentDetail;
use App\Models\School;
use App\Models\SchoolDetail;
use App\Models\ClassLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    // SchoolController
    // public function dashboard()
    // {
    //     $school = auth()->user()->schoolDetail->school;
    //     return view('school.dashboard', compact('school'));
    // }


    public function dashboard()
    {
        $user = auth()->user();
        $schoolDetail = $user->schoolDetail;
        $school = $schoolDetail->school ?? null;

        $class = ClassLevel::all();
        
        if (!$school) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your school profile first.');
        }
        
        // Get counts
        $teachers = TeacherDetail::where('school_id', $school->id)->count();
        $students = StudentDetail::where('school_id', $school->id)->count();
        // $classes = ClassLevel::where('id', $class->class_id)->count();
        
        // Get recent records
        $recentTeachers = TeacherDetail::with('user')
            ->where('school_id', $school->id)
            ->latest()
            ->take(5)
            ->get();
            
        $recentStudents = StudentDetail::with(['user', 'class'])
            ->where('school_id', $school->id)
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard.school', compact(
            'teachers', 
            'students', 
            'recentTeachers', 
            'recentStudents',
            'school'
        ));
    }
    
    /**
     * Display list of teachers
     */
    public function teachers()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school;
        
        $teachers = TeacherDetail::with('user')
            ->where('school_id', $school->id)
            ->paginate(15);
            
        return view('school.teachers.index', compact('teachers'));
    }
    
    /**
     * Show form to create teacher
     */
    public function createTeacher()
    {
        return view('school.teachers.create');
    }


    // fetch classes for each school
    public function classes()
    {
        $classes = ClasseLevel::where('id', $school->id);
        return view('school.students.class', compact('classes'));
    }
    
    /**
     * Store a new teacher
     */
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = auth()->user();
        $school = $user->schoolDetail->school;
        
        // Create user
        $teacher = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'teacher',
            'exam_type' => 'GENERAL',
            'is_active' => true
        ]);
        
        // Create teacher details
        TeacherDetail::create([
            'user_id' => $teacher->id,
            'school_id' => $school->id,
            'employee_id' => 'TCH' . strtoupper(Str::random(6))
        ]);
        
        return redirect()->route('school.teachers')
            ->with('success', 'Teacher created successfully.');
    }
    
    /**
     * Display list of students
     */
    public function students()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school;
        
        $students = StudentDetail::with(['user', 'class'])
            ->where('school_id', $school->id)
            ->paginate(15);
            
        return view('school.students.index', compact('students'));
    }
    
    /**
     * Show form to create student
     */
    // public function createStudent()
    // {
    //     $user = auth()->user();
    //     $school = $user->schoolDetail->school;
    //     $classes = Classes::where('school_id', $school->id)->get();
        
    //     return view('school.students.create', compact('classes'));
    // }
    
    /**
     * Store a new student
     */
    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'class_id' => ['required', 'exists:classes,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user = auth()->user();
        $school = $user->schoolDetail->school;
        
        // Create user
        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'student',
            'exam_type' => $request->exam_type ?? 'GENERAL',
            'is_active' => true
        ]);
        
        // Create student details
        StudentDetail::create([
            'user_id' => $student->id,
            'school_id' => $school->id,
            'class_id' => $request->class_id,
            'registration_number' => 'STU' . strtoupper(Str::random(8)),
            'has_paid' => false
        ]);
        
        return redirect()->route('school.students')
            ->with('success', 'Student created successfully.');
    }
    
    /**
     * Display school reports
     */
    public function reports()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school;
        
        // Add report generation logic here
        
        return view('school.reports.index', compact('school'));
    }

    /**
     * Display student reports
     */
    public function studentReports()
    {
        $user = auth()->user();
        $student_reports = $user->studentDetail->school;
        
        // Add report generation logic here
        
        return view('student.report', compact('student_reports'));
    }
    
    /**
     * Export reports
     */
    public function exportReports(Request $request)
    {
        // Add export logic here
        return redirect()->back()->with('success', 'Report exported successfully.');
    }
    
    /**
     * Show school settings
     */
    public function settings()
    {
        $user = auth()->user();
        $schoolDetail = $user->schoolDetail;
        $school = $schoolDetail->school;
        
        return view('school.settings', compact('school', 'schoolDetail'));
    }
    
    /**
     * Update school settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
        ]);
        
        $user = auth()->user();
        $schoolDetail = $user->schoolDetail;
        $school = $schoolDetail->school;
        
        $school->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        
        return redirect()->route('school.settings')
            ->with('success', 'School settings updated successfully.');
    }
}
