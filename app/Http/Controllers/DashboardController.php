<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use App\Models\ExamAttempt;
use App\Models\Announcement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TopicsImport;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index()
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
            $user = auth()->user();
        
        // Redirect based on role
        switch($user->role) {
            case 'student':
                return redirect()->route('student.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'school':
                return redirect()->route('school.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'referrer':
                return redirect()->route('referrer.dashboard');  
            default:
                return redirect()->route('login');
        }
    }

    public function admin()
    {
        $schools = \App\Models\School::count();

        $teachers = \App\Models\User::where('role', 'teacher')->count();

        $students = \App\Models\User::where('role', 'student')->count();

        $referrers = \App\Models\User::where('role', 'referrer')->count();

        $totalUsers = \App\Models\User::count();

        $questions = DB::table('question_banks')->count();

        $results = DB::table('result_scores')->count();

        $revenue_from_payment = DB::table('payments')
            ->where('status', 'success')
            ->sum('amount');

        $revenue_from_bulk_payment = DB::table('bulk_payments')
            ->where('status', 'success')
            ->sum('amount');
        
        $revenue = $revenue_from_payment + $revenue_from_bulk_payment;  

        $withdrawals = DB::table('withdrawals')
            ->where('status', 'paid')
            ->sum('amount');

        $pendingWithdrawals = DB::table('withdrawals')
            ->where('status', 'pending')
            ->count();

        return view('dashboard.admin', compact(
            'schools',
            'teachers',
            'students',
            'referrers',
            'totalUsers',
            'questions',
            'results',
            'revenue',
            'withdrawals',
            'pendingWithdrawals'
        ));
    }

    public function teacher()
    {

        $teacher = auth()->user();

        $students = StudentDetail::where('school_id',$teacher->teacherDetail->school_id)->count();

        $questions = Question::where('created_by',$teacher->id)->count();

        return view('dashboard.teacher',[
        'students'=>$students,
        'questions'=>$questions
        ]);

    }


    public function school()
    {

        $school = auth()->user()->schoolDetail->school_id;

        $teachers = TeacherDetail::where('school_id',$school)->count();

        $students = StudentDetail::where('school_id',$school)->count();

        return view('dashboard.school',[
        'teachers'=>$teachers,
        'students'=>$students
        ]);

    }

    public function withdrawals()
    {
        $rows = Withdrawal::latest()->paginate(15);

        $pending = Withdrawal::where('status', 'pending')->count();
        $approved = Withdrawal::where('status', 'approved')->count();
        $paid = Withdrawal::where('status', 'paid')->count();

        $requestedAmount = Withdrawal::sum('amount');
        $paidAmount = Withdrawal::where('status', 'paid')->sum('amount');

        return view('admin.withdrawals', compact(
            'rows',
            'pending',
            'approved',
            'paid',
            'requestedAmount',
            'paidAmount'
        ));
    }

    public function approveWithdrawal($id)
    {
        $row = Withdrawal::findOrFail($id);

        $row->update([
            'status' => 'approved'
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => $row->user_id,
            'activity' => 'Withdrawal approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Withdrawal approved');
    }

    public function rejectWithdrawal($id)
    {
        $row = Withdrawal::findOrFail($id);

        $row->update([
            'status' => 'rejected'
        ]);

        DB::table('wallets')
            ->where('user_id', $row->user_id)
            ->increment('balance', $row->amount);

        DB::table('activity_logs')->insert([
            'user_id' => $row->user_id,
            'activity' => 'Withdrawal rejected and funds returned',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Withdrawal rejected');
    }

    public function paidWithdrawal($id)
    {
        $row = Withdrawal::findOrFail($id);

        $row->update([
            'status' => 'paid'
        ]);

        DB::table('activity_logs')->insert([
            'user_id' => $row->user_id,
            'activity' => 'Withdrawal paid successfully',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Marked as paid');
    }

    public function withdrawHistory()
    {
        $rows = \App\Models\Withdrawal::latest()->paginate(10);

        return view('admin.withdraw-history', compact('rows'));
    }

    public function analytics()
    {
        $monthlyRevenuePayments = DB::table('payments')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as ym,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('status', 'success')
            ->groupBy('ym', 'month')
            ->orderBy('ym')
            ->get();

        $monthlyRevenueBulk = DB::table('bulk_payments')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as ym,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('status', 'success')
            ->groupBy('ym', 'month')
            ->orderBy('ym')
            ->get();

        $monthlyPayout = DB::table('withdrawals')
            ->selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as ym,
                DATE_FORMAT(created_at, '%b') as month,
                SUM(amount) as total
            ")
            ->where('status', 'paid')
            ->groupBy('ym', 'month')
            ->orderBy('ym')
            ->get();

        return view('admin.analytics', compact(
            'monthlyRevenuePayments',
            'monthlyRevenueBulk',
            'monthlyPayout'
        ));
    }

    public function users()
    {
        $rows = \App\Models\User::latest()->paginate(10);

        return view('admin.users', compact('rows'));
    }

    public function deleteUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot delete your own account');
        }

        if ($user->role == 'admin') {
            return back()->with('error', 'Admin account cannot be deleted');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }

    public function toggleUser($id)
    {
        $user = \App\Models\User::findOrFail($id);

        if ($user->role == 'admin') {
            return back()->with('error','Admin cannot be suspended');
        }

        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot suspend yourself');
        }

        $user->status = $user->status == 'active'
            ? 'suspended'
            : 'active';

        $user->save();

        return back()->with('success', 'User status updated');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('admin.profile', compact('user'));
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

            // \Log::info('File upload detected', [
            //     'original_name' => $file->getClientOriginalName(),
            //     'size' => $file->getSize()
            // ]);

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
        return view('admin.password');
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

        $user->password = Hash::make($request->new_password);
        $user->save();

        DB::table('activity_logs')->insert([
            'user_id'    => $user->id,
            'activity'   => 'Changed admin password',
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
            ->paginate(20);

        return view('admin.activity', compact('logs'));
    }

    public function settings()
    {
        $sub = \App\Models\Subscription::first();

        return view('admin.settings', compact('sub'));
    }

    public function updateSettings(Request $request)
    {
        $sub = \App\Models\Subscription::first();

        $sub->update([
            'sub_amount' => $request->sub_amount,
            'email_sub'  => $request->email_sub
        ]);

        DB::table('activity_logs')->insert([
            'user_id'    => auth()->id(),
            'activity'   => 'Updated system settings',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Settings updated successfully');
    }


    public function support()
    {
        $rows = DB::table('support_tickets')
            ->latest()
            ->paginate(10);

        return view('admin.support', compact('rows'));
    }

    public function resolveSupport($id)
    {
        DB::table('support_tickets')
            ->where('id', $id)
            ->update([
                'status' => 'resolved',
                'updated_at' => now()
            ]);

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Resolved support ticket',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Ticket marked as resolved');
    }

    public function deleteSupport($id)
    {
        DB::table('support_tickets')
            ->where('id', $id)
            ->delete();

        DB::table('activity_logs')->insert([
            'user_id' => auth()->id(),
            'activity' => 'Deleted support ticket',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Ticket deleted');
    }


    public function announcements()
    {
        $rows = \App\Models\Announcement::latest()
            ->paginate(10);

        return view(
            'admin.announcements',
            compact('rows')
        );
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title'    => 'required',
            'audience' => 'required',
            'message'  => 'required'
        ]);

        \App\Models\Announcement::create([
            'title'    => $request->title,
            'audience' => $request->audience,
            'message'  => $request->message,
            'status'   => 'active'
        ]);

        return back()->with(
            'success',
            'Announcement posted'
        );
    }

    public function toggleAnnouncement($id)
    {
        $row = \App\Models\Announcement::findOrFail($id);

        $row->status =
            $row->status == 'active'
            ? 'inactive'
            : 'active';

        $row->save();

        return back()->with(
            'success',
            'Announcement updated'
        );
    }

    public function deleteAnnouncement($id)
    {
        \App\Models\Announcement::findOrFail($id)
            ->delete();

        return back()->with(
            'success',
            'Announcement deleted'
        );
    }

    public function questionBanks(Request $request)
    {
        $query = \App\Models\QuestionBank::with([
            'subject',
            'topic',
            'classLevel'
        ]);

        if ($request->class_id) {
            $query->where(
                'class_level_id',
                $request->class_id
            );
        }

        if ($request->subject_id) {
            $query->where(
                'subject_id',
                $request->subject_id
            );
        }

        if ($request->search) {
            $query->where(
                'question_text',
                'like',
                '%' . $request->search . '%'
            );
        }

        $rows = $query->latest()->paginate(20);

        $classes = \App\Models\ClassLevel::all();
        $subjects = \App\Models\Subject::all();

        return view(
            'admin.question-banks.index',
            compact(
                'rows',
                'classes',
                'subjects'
            )
        );
    }

    public function deleteQuestionBank($id)
    {
        \App\Models\QuestionBank::findOrFail($id)
            ->delete();

        return back()->with(
            'success',
            'Question deleted'
        );
    }

    public function subjectTopicRecord()
    {
        // Get subjects with their topics count
        $subjects = Subject::withCount('topic')->get();
        
        // Get all topics with their subjects and question count (with pagination)
        $topics = Topic::with('subject')
            ->withCount('questionBanks')
            ->orderBy('subject_id')
            ->paginate(10); // 10 topics per page
        
        return view('admin.subject-topic-record', compact('subjects', 'topics'));
    }

    public function showUploadForm()
    {
        return view('admin.topics.bulk-upload');
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            // Load Excel data
            $data = Excel::toArray([], $request->file('excel_file'));
            
            if (empty($data) || empty($data[0])) {
                return redirect()->back()->with('error', 'Excel file is empty');
            }
            
            // Get the first sheet
            $rows = $data[0];
            
            // Get headers (first row)
            $headers = array_shift($rows);
            
            // Normalize headers (convert to lowercase, remove spaces)
            $headers = array_map(function($header) {
                return strtolower(trim($header));
            }, $headers);
            
            $successCount = 0;
            $failedCount = 0;

            $skippedCount = 0;
            $errors = [];
            
            foreach ($rows as $rowIndex => $row) {
                try {
                    // Map row data to headers
                    // ENSURE SAME COLUMN COUNT
                    $row = array_pad($row, count($headers), null);

                    $rowData = array_combine($headers, $row);

                    if (!$rowData) {

                        $failedCount++;

                        $errors[] =
                            "Row " . ($rowIndex + 2) .
                            ": Invalid column structure";

                        continue;
                    }
                    
                    // Extract values
                    $classLevelId = $rowData['class_level_id'] ?? null;
                    $subjectId = $rowData['subject_id'] ?? null;
                    $topic = $rowData['topic'] ?? null;
                    
                    // Validate
                    if (!$classLevelId || !$subjectId || !$topic) {
                        $failedCount++;
                        $errors[] = "Row " . ($rowIndex + 2) . ": Missing required data";
                        continue;
                    }
                    
                    // Check if exists
                    $exists = \App\Models\Topic::where('class_level_id', $classLevelId)
                        ->where('subject_id', $subjectId)
                        ->where('topic', $topic)
                        ->exists();
                    
                    // if ($exists) {
                    //     $failedCount++;
                    //     $errors[] = "Row " . ($rowIndex + 2) . ": Topic '{$topic}' already exists";
                    //     continue;
                    // }

                    if ($exists) {

                        $skippedCount++;

                        continue;
                    }
                    
                    // Insert directly
                    \App\Models\Topic::create([
                        'class_level_id' => $classLevelId,
                        'subject_id' => $subjectId,
                        'topic' => $topic,
                    ]);
                    
                    $successCount++;
                    
                } catch (\Exception $e) {
                    $failedCount++;
                    $errors[] =

        "Row " . ($rowIndex + 2) .

        ": " .

        $e->getMessage() .

        " | Data: " .

        json_encode($row);
                }
            }
            
            // $message = "$successCount topic(s) uploaded successfully!";

            $message =
            "$successCount topic(s) uploaded successfully!";

                if ($skippedCount > 0) {

                $message .=
                    " $skippedCount duplicate topic(s) skipped.";
            }
            
            if ($failedCount > 0) {
                $message .= " $failedCount topic(s) failed.";
                if (!empty($errors)) {
                    session()->flash('upload_errors', array_slice($errors, 0, 30));
                }
                return redirect()->back()->with('warning', $message);
            }
            
            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            \Log::error('Bulk upload error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    public function downloadTemplate()
    {
        // Create a sample CSV template
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="topics_template.csv"',
        ];
        
        $columns = ['class_level_id', 'subject_id', 'topic'];
        
        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            // Sample data
            fputcsv($file, [1, 1, 'Introduction to Algebra']);
            fputcsv($file, [2, 2, 'Nouns and Pronouns']);
            fputcsv($file, [3, 3, 'Motion and Force']);
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}