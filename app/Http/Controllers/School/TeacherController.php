<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassLevel;
use App\Models\SchoolClass;
use App\Models\TeacherDetail;
use App\Mail\UserCreatedMail;
use App\Models\StudentDetail;
use App\Models\ExamAttempt;
use App\Models\Question;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class TeacherController extends Controller
{

    public function dashboard()
    {

        $teacher = auth()->user();
        
        // Get students in teacher's class
        $students = StudentDetail::where('class_id', $teacher->teacherDetail->class_id)
            ->pluck('user_id');
        
        // Get all attempts from these students with relationships
        $attempts = ExamAttempt::whereIn('user_id', $students)
            ->with(['user', 'exam'])
            ->latest()
            ->get();
        
        // Get recent attempts (last 10)
        $recentAttempts = $attempts->take(10);
        
        // Get teacher's questions count
        $questionsCount = Question::where('created_by', $teacher->id)->count();
        
        return view('dashboard.teacher', [
            'studentsCount' => $students->count(),
            'avgScore' => $attempts->avg('score'),
            'totalAttempts' => $attempts->count(),
            'questionsCount' => $questionsCount,
            'recentAttempts' => $recentAttempts
        ]);
    }

    /**
     * Display available school.
     */

    public function create()
    {
        $user = auth()->user();
        $school = $user->schoolDetail->school ?? null;

        if (!$school) {
            return redirect()->back()->with('error', 'School not found.');
        }

        $classes = SchoolClass::with('classLevel')
            ->where('school_id', $school->id)
            ->get()
            ->map(fn($row) => (object)[
                'id' => $row->class_level_id,
                'name' => $row->classLevel->name
            ]);

        return view('school.teacher.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teachers' => 'required|array|min:1',
            'teachers.*.name' => 'required|string|max:255',
            'teachers.*.email' => 'required|email|unique:users,email',
            'teachers.*.phone' => 'required|string|max:20',
            'teachers.*.class_id' => 'required|exists:classes,id',
        ]);

        // Get school id of logged in school
        $schoolDetail = auth()->user()->schoolDetail;
        $schoolId = $schoolDetail->school_id;
        
        // $password = Str::random(8);
        $password = 'password123'; // Default password
        $successCount = 0;
        $errors = [];

        foreach ($request->teachers as $index => $teacherData) {
            try {
                // Check if email already exists (additional check)
                $existingUser = User::where('email', $teacherData['email'])->exists();
                if ($existingUser) {
                    $errors[] = "Teacher " . ($index + 1) . " ({$teacherData['email']}) already exists.";
                    continue;
                }

                // Create teacher user
                $user = User::create([
                    'name' => $teacherData['name'],
                    'email' => $teacherData['email'],
                    'password' => Hash::make($password),
                    'phone' => $teacherData['phone'],
                    'role' => 'teacher',
                    'exam_type' => 'GENERAL',
                    'is_active' => true
                ]);

                // Send Email (optional - can be disabled for bulk upload)
                try {
                    Mail::to($user->email)->send(new UserCreatedMail($user, $password));
                } catch (\Exception $e) {
                    \Log::error('Failed to send email to: ' . $user->email);
                }

                // Link teacher to school and class
                TeacherDetail::create([
                    'user_id' => $user->id,
                    'class_id' => $teacherData['class_id'],
                    'school_id' => $schoolId,
                    'has_paid' => true
                ]);

                $successCount++;

            } catch (\Exception $e) {
                $errors[] = "Teacher " . ($index + 1) . " ({$teacherData['name']}) failed: " . $e->getMessage();
            }
        }

        $message = "$successCount teacher(s) created successfully!";
        
        if (!empty($errors)) {
            $message .= " Errors: " . implode('; ', $errors);
            return redirect()->back()->with('warning', $message);
        }

        return redirect()->route('school.teachers')->with('success', $message);
    }

    public function profile()
    {
        $user = auth()->user();

        return view('teacher.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        \Log::info('Profile update request received', [
            'has_file' => $request->hasFile('profile_photo'),
            'has_captured_photo' => !empty($request->captured_photo),
            'all_files' => $request->allFiles(),
        ]);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // ✅ MUST COME FIRST
        $user = auth()->user();

        // ✅ Update basic info
        $user->name  = $request->name;
        $user->email = $request->email;

        // ✅ Ensure directory exists
        if (!file_exists(public_path('storage/profile'))) {
            mkdir(public_path('storage/profile'), 0777, true);
        }

        // =========================================
        // ✅ HANDLE CAMERA CAPTURE (BASE64)
        // =========================================

        if (!empty($request->captured_photo)) {

            \Log::info('Captured photo detected');

            // Delete old photo
            if (
                $user->profile_photo &&
                file_exists(public_path('storage/profile/' . $user->profile_photo))
            ) {
                unlink(public_path('storage/profile/' . $user->profile_photo));
            }

            // Extract image
            $image = $request->captured_photo;

            $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);

            $image = str_replace(' ', '+', $image);

            $imageData = base64_decode($image);

            // Generate filename
            $filename = Str::uuid() . '.jpg';

            // Save image
            file_put_contents(
                public_path('storage/profile/' . $filename),
                $imageData
            );

            // Save filename to DB
            $user->profile_photo = $filename;

            \Log::info('Captured photo saved', [
                'filename' => $filename
            ]);
        }

        // =========================================
        // ✅ HANDLE NORMAL FILE UPLOAD
        // =========================================

        elseif ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');

            // Delete old photo
            if (
                $user->profile_photo &&
                file_exists(public_path('storage/profile/' . $user->profile_photo))
            ) {
                unlink(public_path('storage/profile/' . $user->profile_photo));
            }

            $filename = Str::uuid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('storage/profile'),
                $filename
            );

            $user->profile_photo = $filename;

            \Log::info('Uploaded photo saved', [
                'filename' => $filename
            ]);
        }

        // ✅ SAVE USER
        $user->save();

        // ✅ Activity log
        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Updated profile',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'success',
            'Profile updated successfully'
        );
    }

    public function password()
    {
        return view('teacher.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => $user->id,
            'activity' => 'Changed password',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Password changed successfully');
    }

    public function activity()
    {
        $logs = DB::table('activity_logs')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('teacher.activity', compact('logs'));
    }

    public function myQuestions()
    {
        $teacher = auth()->user()->teacherDetail;

        $rows = \App\Models\Question::where(
                'school_id',
                $teacher->school_id
            )
            ->where(
                'created_by',
                auth()->id()
            )
            ->latest()
            ->paginate(10);

        return view(
            'teacher.questions.index',
            compact('rows')
        );
    }

    // student list
    public function students(Request $request)
    {
        $teacher = auth()->user();
        
        // Get teacher's ID
        $teacherId = $teacher->id;
        
        // Get search term from request
        $search = $request->get('search');
        
        // FETCH STUDENTS that have this teacher_id in their student_details
        $students = \App\Models\User::whereHas('studentDetail', function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->with(['studentDetail.schoolClass.classLevel']) // Load schoolClass and its classLevel
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]); // Preserve search query in pagination
        
        return view('teacher.students.index', compact('students', 'search'));
    }

    public function delete($id)
    {
        $question = \App\Models\Question::findOrFail($id);

        if ($question->created_by != auth()->id()) {
            abort(403);
        }

        $question->delete();

        return back()->with('success', 'Question deleted');
    }

}
