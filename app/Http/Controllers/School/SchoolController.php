<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\SchoolDetails;
use App\Models\User;
use App\Models\TeacherDetail;
use App\Models\StudentDetail;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolDetail;
use App\Models\ClassLevel;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolController extends Controller
{

    public function dashboard()
    {

        $user = auth()->user();
        $schoolDetail = $user->schoolDetail;
        $school = $schoolDetail->school ?? null;
        
        if (!$school) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your school profile first.');
        }
        
        // Get counts
        $teachers = TeacherDetail::where('school_id', $school->id)->count();
        $students = StudentDetail::where('school_id', $school->id)->count();
        
        // Get classes count for this school (fixed)
        $classes = SchoolClass::where('school_id', $school->id)->count();

        // Active users
        // $activeUsers = User::where('id', auth()->id)->count();
        
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
            'classes',  // Now this is a count, not a collection
            'recentTeachers', 
            'recentStudents',
            'school'
        ));
    }
    


    public function teachers(Request $request)
    {
        $user = auth()->user();

        $school = $user->schoolDetail->school;

        $school_id = $school->id;

        $query = \App\Models\TeacherDetail::with('user')
            ->where('school_id', $school_id);

        if ($request->search) {

            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");

            });
        }

        $rows = $query->latest()->paginate(10);

        return view(
            'school.teacher.index',
            compact('rows')
        );
    }

    public function editTeacher($id)
    {
        $row = \App\Models\TeacherDetail::with('user')
            ->findOrFail($id);

        return view(
            'school.teacher.edit',
            compact('row')
        );
    }

    public function updateTeacher(Request $request, $id)
    {
        $teacher = \App\Models\TeacherDetail::with('user')
            ->findOrFail($id);

        $teacher->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return back()->with(
            'success',
            'Teacher updated successfully'
        );
    }

    public function toggleTeacher($id)
    {
        $user = \App\Models\User::findOrFail($id);

        $newStatus =
            ($user->status == 'active')
            ? 'suspended'
            : 'active';

        \Illuminate\Support\Facades\DB::table('users')
            ->where('id', $id)
            ->update([
                'status' => $newStatus
            ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Teacher status updated successfully'
            );
    }

    public function deleteTeacher($id)
    {
        $teacher = \App\Models\TeacherDetail::with('user')
            ->findOrFail($id);

        $teacher->user()->delete();

        $teacher->delete();

        return back()->with(
            'success',
            'Teacher deleted successfully'
        );
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

    public function students(Request $request)
    {
        $school = \App\Models\SchoolDetail::where(
            'user_id',
            auth()->id()
        )->first();

        $query = \App\Models\StudentDetail::with([
                'user',
                'classLevel'
            ])
            ->where(
                'school_id',
                $school->school_id
            );

        if ($request->search) {

            $query->where(function($q) use ($request) {

                $q->where(
                    'registration_number',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhereHas('user', function($qq) use ($request) {

                    $qq->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );

                });

            });
        }

        if ($request->class_id) {

            $query->where(
                'class_id',
                $request->class_id
            );
        }

        $rows = $query->latest()->paginate(10);

        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();

        $classes = SchoolClass::with('classLevel')
            ->where('school_id', $school->id)
            ->get()
            ->map(fn($row) => (object)[
                'id' => $row->class_level_id,
                'name' => $row->classLevel->name
            ]);

        return view(
            'school.student.index',
            compact('rows', 'classes')
        );
    }

    public function editStudent($id)
    {
        $row = \App\Models\StudentDetail::with('user')
            ->findOrFail($id);

        return view(
            'school.student.edit',
            compact('row')
        );
    }

    public function updateStudent(Request $request, $id)
    {
        $student = \App\Models\StudentDetail::with('user')
            ->findOrFail($id);

        $student->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return back()->with(
            'success',
            'Student updated successfully'
        );
    }

    public function toggleStudent($id)
    {
        $student = \App\Models\StudentDetail::with('user')
            ->findOrFail($id);

        $newStatus =
            $student->user->status == 'active'
            ? 'suspended'
            : 'active';

        $student->user->update([
            'status' => $newStatus
        ]);

        return back()->with(
            'success',
            'Student status updated'
        );
    }

    public function deleteStudent($id)
    {
        $student = \App\Models\StudentDetail::with('user')
            ->findOrFail($id);

        $student->user()->delete();

        $student->delete();

        return back()->with(
            'success',
            'Student deleted successfully'
        );
    }
    
    
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

    public function profile()
    {
        $user = auth()->user();

        $school = \App\Models\School::where('id', $user->id)->first();

        return view('school.profile', compact('user', 'school'));
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

    

    public function manageResults()
    {
        $rows = DB::table('result_scores')
            ->select('term', 'status', DB::raw('COUNT(*) as total'))
            ->groupBy('term', 'status')
            ->get();

        return view('school.results.manage', compact('rows'));
    }

    public function releaseResults(Request $request)
    {
        DB::table('result_scores')
            ->where('term', $request->term)
            ->update([
                'status' => 'released'
            ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Released ' . $request->term . ' results',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Results released successfully');
    }

    public function promotionPage()
    {
        return view('school.promotion');
    }

    public function runPromotion()
    {
        $students = DB::table('student_details')->get();

        $promoted = 0;
        $retained = 0;

        foreach ($students as $student) {

            $avg = DB::table('result_scores')
                ->where('student_details_id', $student->id)
                ->where('term', 'Third Term')
                ->where('status', 'release')
                ->avg('total_score');

            if ($avg >= 50) {

                DB::table('student_details')
                    ->where('id', $student->id)
                    ->increment('class_id', 1);

                $promoted++;

            } else {

                $retained++;
            }
        }

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Ran student promotion',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'success',
            "$promoted students promoted, $retained retained."
        );
    }

    public function fees()
    {
        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();

        $classes = SchoolClass::with('classLevel')
            ->where('school_id', $school->id)
            ->get()
            ->map(fn($row) => (object)[
                'id' => $row->class_level_id,
                'name' => $row->classLevel->name
            ]);


        $rows = DB::table('school_fees')

            ->leftJoin(
                'school_classes',
                'school_fees.class_id',
                '=',
                'school_classes.id'
            )

            ->leftJoin(
                'classes',
                'school_classes.class_level_id',
                '=',
                'classes.id'
            )

            ->select(
                'school_fees.*',
                'classes.name as class_name'
            )

            ->where('school_fees.school_id', $school->id)

            ->latest('school_fees.id')

            ->paginate(10);

        return view('school.fees', compact(
            'classes',
            'rows'
        ));
    }

    public function saveFees(Request $request)
    {
        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();

        DB::table('school_fees')->insert([
            'school_id' => $school->id,
            'class_id' => $request->class_id,
            'term' => $request->term,
            'session' => $request->session,
            'tuition' => $request->tuition,
            'uniforms' => $request->uniforms,
            'sports_wear' => $request->sports_wear,
            'books' => $request->books,
            'exam_fee' => $request->exam_fee,
            'pta_levy' => $request->pta_levy,
            'other_fee' => $request->other_fee,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Updated school fees',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'School fees saved');
    }

    public function editFee($id)
    {
        $fee = DB::table('school_fees')->where('id', $id)->first();

        $classes = DB::table('classes')->get();

        return view('school.fees-edit', compact('fee', 'classes'));
    }

    public function updateFee(Request $request, $id)
    {
        DB::table('school_fees')
            ->where('id', $id)
            ->update([
                'class_id' => $request->class_id,
                'term' => $request->term,
                'session' => $request->session,
                'tuition' => $request->tuition,
                'uniforms' => $request->uniforms,
                'sports_wear' => $request->sports_wear,
                'books' => $request->books,
                'exam_fee' => $request->exam_fee,
                'pta_levy' => $request->pta_levy,
                'other_fee' => $request->other_fee,
                'updated_at' => now()
            ]);

        return redirect()
            ->route('school.fees')
            ->with('success', 'Fees updated successfully');
    }

    public function deleteFee($id)
    {
        DB::table('school_fees')
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Fee deleted successfully');
    }

    public function books()
    {
        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();


        $classes = SchoolClass::with('classLevel')
            ->where('school_id', $school->id)
            ->get()
            ->map(fn($row) => (object)[
                'id' => $row->class_level_id,
                'name' => $row->classLevel->name
            ]);

        $rows = DB::table('school_books')

            ->join(
                'school_classes',
                'school_books.class_id',
                '=',
                'school_classes.id'
            )

            ->join(
                'classes',
                'school_classes.class_level_id',
                '=',
                'classes.id'
            )

            ->select(
                'school_books.*',
                'classes.name as class_name'
            )

            ->where('school_books.school_id', $school->id)

            ->latest('school_books.id')

            ->paginate(10);

        return view('school.books', compact(
            'classes',
            'rows'
        ));
    }

    public function saveBooks(Request $request)
    {
        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();

        DB::table('school_books')->insert([
            'school_id' => $school->id,
            'class_id' => $request->class_id,
            'term' => $request->term,
            'session' => $request->session,
            'textbooks' => $request->textbooks,
            'notebooks' => $request->notebooks,
            'workbooks' => $request->workbooks,
            'materials' => $request->materials,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Updated school books list',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Books saved successfully');
    }

    public function deleteBooks($id)
    {
        DB::table('school_books')
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Books deleted');
    }

    public function editBooks($id)
    {
        $book = DB::table('school_books')
            ->where('id', $id)
            ->first();

        $classes = DB::table('classes')->get();

        return view('school.books-edit', compact(
            'book',
            'classes'
        ));
    }

    public function updateBooks(Request $request, $id)
    {
        DB::table('school_books')
            ->where('id', $id)
            ->update([
                'class_id' => $request->class_id,
                'term' => $request->term,
                'session' => $request->session,
                'textbooks' => $request->textbooks,
                'notebooks' => $request->notebooks,
                'workbooks' => $request->workbooks,
                'materials' => $request->materials,
                'updated_at' => now()
            ]);

        return redirect()
            ->route('school.books')
            ->with('success', 'Books updated successfully');
    }

    public function remarksPage()
    {
        $students = DB::table('student_details')
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->select(
                'student_details.user_id',
                'student_details.registration_number',
                'users.name'
            )
            ->get();

        return view('school.results.remarks', compact('students'));
    }

    public function saveRemarks(Request $request)
    {
        DB::table('result_scores')
            ->where('student_details_id', $request->student_id)
            ->where('term', $request->term)
            ->update([
                'teacher_remark' => $request->teacher_remark,
                'principal_remark' => $request->principal_remark
            ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Updated student remarks',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Remarks saved successfully');
    }


    public function feePayments()
    {
        $school = DB::table('school_details')
            ->where('user_id', auth()->id())
            ->first();

        $rows = DB::table('school_fee_payments')
            ->join('student_details', 'school_fee_payments.student_id', '=', 'student_details.user_id')
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->select(
                'school_fee_payments.*',
                'users.name',
                'student_details.registration_number'
            )
            ->where('school_fee_payments.school_id', $school->id)
            ->latest('school_fee_payments.id')
            ->paginate(15);

        return view('school.fee-payments', compact('rows'));
    }

    public function confirmFeePayment($id)
    {
        DB::table('school_fee_payments')
            ->where('id', $id)
            ->update([
                'status' => 'confirmed',
                'updated_at' => now()
            ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Confirmed school fee payment',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Payment confirmed');
    }

    public function password()
    {
        return view('referrer.password');
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

        return view('referrer.activity', compact('logs'));
    }

    public function questions(Request $request)
    {
        $school = auth()->user()->schoolDetail->school;

        // ✅ GET TEACHERS IN THIS SCHOOL
        $teachers = \App\Models\User::where('role', 'teacher')
            ->whereHas('teacherDetail', function ($q) use ($school) {
                $q->where('school_id', $school->id);
            })
            ->get();

        // ✅ GET SUBJECTS (you can refine later per school)
        $subjects = \App\Models\Subject::all();

        $query = \App\Models\Question::with(['user', 'subject'])
            ->where('school_id', $school->id)
            ->where('exam_cat_id', 1)
            ->where('status', 'pending');

        if ($request->teacher_id) {
            $query->where('created_by', $request->teacher_id);
        }

        if ($request->subject_id) {
            $query->where('subject_id', $request->subject_id);
        }

        $rows = $query->with(['user', 'subject', 'options'])
        ->latest()
        ->paginate(20);

        return view(
            'school.questions.index',
            compact('rows', 'teachers', 'subjects')
        );
    }

    public function approve($id)
    {
        $question = \App\Models\Question::findOrFail($id);

        $question->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Question approved');
    }

    public function bulkApprove(Request $request)
    {
        $ids = $request->question_ids;

        if (!$ids || count($ids) == 0) {
            return back()->with('error', 'No questions selected');
        }

        \App\Models\Question::whereIn('id', $ids)
            ->update(['status' => 'approved']);

        return back()->with('success', count($ids) . ' questions approved');
    }

}
