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

    // public function dashboard()
    // {
    //     $user = auth()->user();

    //     $teacher = \App\Models\TeacherDetail::where(
    //         'user_id',
    //         $user->id
    //     )->first();

    //     $subjects = \App\Models\TeacherSubject::where(
    //         'teacher_id',
    //         $teacher->user_id
    //     )->count();

    //     $students = \App\Models\StudentDetail::where(
    //         'school_id',
    //         $teacher->school_id
    //     )->count();

    //     $results = \App\Models\ResultScore::where(
    //         'created_by',
    //         $user->id
    //     )->count();

    //     $announcements = \App\Models\Announcement::where(
    //         'status',
    //         'active'
    //     )
    //     ->whereIn('audience', ['all', 'teacher'])
    //     ->latest()
    //     ->take(5)
    //     ->get();

    //     return view(
    //         'dashboard.teacher',
    //         compact(
    //             'subjects',
    //             'students',
    //             'results',
    //             'announcements'
    //         )
    //     );
    // }

    public function dashboard()
    {

        $announcements = \App\Models\Announcement::where(
            'status',
            'active'
        )
        ->where(function ($q) {

            $q->where('audience', 'all')
              ->orWhere(
                  'audience',
                  auth()->user()->role
              );
        })
        ->latest()
        ->take(5)
        ->get();

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
        
        return view('dashboard.teacher', compact('announcements'), [
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'class_id' => 'required',
        ]);

        // Get school id of logged in school
        $schoolId = auth()->user()->schoolDetail->school_id;

        // Create teacher user
        // $password = Str::random(8);
        $password = 'password123';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'phone' => $request->phone,
            'role' => 'teacher',
            'exam_type' => 'GENERAL',
            'is_active' => true
        ]);

        // Send Email
        Mail::to($user->email)->send(new UserCreatedMail($user, $password));

        // Link teacher to school
        TeacherDetail::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'school_id' => $schoolId,
            'has_paid' => true
        ]);

        return redirect()->back()->with('success','Teacher created successfully');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('teacher.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email'
        ]);

        $user = auth()->user();

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('storage/profile'), $filename);

            $user->profile_photo = $filename;
        }

        if ($request->hasFile('signature')) {

            $file = $request->file('signature');

            $name = time() . '_' . $file->getClientOriginalName();

            $file->storeAs(
                'public/signatures',
                $name
            );

            $user->signature = $name;
        }

        $user->save();

        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Updated profile',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Profile updated successfully');
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
