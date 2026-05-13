<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\School\TeacherController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\School\SchoolClassController;
use App\Http\Controllers\School\TeacherSubjectController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\QRcodeController;
use App\Http\Controllers\Student\LeaderboardController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\QuestionBankController;
use App\Http\Controllers\AIQuestionController;
use App\Http\Controllers\Admin\AdminAIQuestionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ReferrerController;
use App\Http\Controllers\BulkPaymentController;
use App\Http\Controllers\Student\External\PracticeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\NotificationController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notifications/read', function () {

    DB::table('activity_logs')
        ->where('user_id', auth()->id())
        ->update(['is_read' => 1]);

    return back();

})->name('notifications.read');

/*
|--------------------------------------------------------------------------
| Protected Routes (MUST PAY)
|--------------------------------------------------------------------------
*/


// Payment routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])
        ->name('payment.show');
    
    Route::post('/payment/initialize', [PaymentController::class, 'initialize'])
        ->name('payment.initialize');
    
    Route::get('/payment/callback', [PaymentController::class, 'callback'])
        ->name('payment.callback');
    
    Route::get('/payment/success', [PaymentController::class, 'success'])
        ->name('payment.success');
    
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])
        ->name('payment.cancel');
        
    Route::get('/payment/receipt/{reference}', 
        [PaymentController::class,'downloadReceipt']
    )->name('payment.receipt');
});


// Notifications Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::get('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

Route::middleware(['auth','verified', \App\Http\Middleware\CheckPayment::class])->group(function(){

    // Main dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Student dashboard
    Route::prefix('student')->name('student.')->group(function () {

        Route::get('/dashboard', [StudentController::class, 'dashboard'])
            ->name('dashboard');
    });

    // admin dashboard
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'admin'])
            ->name('dashboard');
 
    });
});

// Techical Support
Route::middleware(['auth'])->group(function () {

    Route::get(
        '/support',
        [SupportController::class, 'index']
    )->name('support.index');

    Route::get(
        '/support/create',
        [SupportController::class, 'create']
    )->name('support.create');

    Route::post(
        '/support/store',
        [SupportController::class, 'store']
    )->name('support.store');

});


/*
|--------------------------------------------------------------------------
| Password Reset Routes
|--------------------------------------------------------------------------
*/

// Password Reset Routes
Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    
    Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    
    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    
    // 🔴 CHANGE THIS - Use POST instead of PUT
    Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

Route::middleware('guest')->group(function () {

    Route::get(
        '/reset-password/{token}',
        [NewPasswordController::class, 'create']
    )->name('password.reset');

    Route::post(
        '/reset-password',
        [NewPasswordController::class, 'store']
    )->name('password.store');
});


/*
|--------------------------------------------------------------------------
| Admin Routes 
|--------------------------------------------------------------------------
*/

// admin route starts here
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/withdrawals', [App\Http\Controllers\DashboardController::class, 'withdrawals'])
        ->name('admin.withdrawals');

    Route::post('/withdrawals/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveWithdrawal'])
        ->name('admin.withdraw.approve');

    Route::post('/withdrawals/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectWithdrawal'])
        ->name('admin.withdraw.reject');

    Route::post('/withdrawals/{id}/paid', [App\Http\Controllers\AdminController::class, 'paidWithdrawal'])
        ->name('admin.withdraw.paid');
});

Route::get('/admin/analytics', [DashboardController::class, 'analytics'])
            ->name('dashboard.leaderboard'); 

Route::get('/admin/withdraw-history', [DashboardController::class, 'withdrawHistory'])
    ->name('admin.withdraw.history');
    
Route::get('/admin/analytics', [DashboardController::class, 'analytics'])
    ->name('admin.analytics');   
    
Route::get('/admin/users', [DashboardController::class, 'users'])
    ->name('admin.users');

Route::post('/admin/users/{id}/toggle', [DashboardController::class, 'toggleUser'])
    ->name('admin.users.toggle');
    
Route::post('/admin/users/{id}/delete', [dashboardController::class, 'deleteUser'])
    ->name('admin.users.delete'); 
    
Route::get('/admin/profile', [DashboardController::class, 'profile'])
    ->name('admin.profile');

Route::post('/admin/profile', [DashboardController::class, 'updateProfile'])
    ->name('admin.profile.update');
    
Route::get('/admin/password', [DashboardController::class, 'password'])
    ->name('admin.password');

Route::post('/admin/password', [DashboardController::class, 'updatePassword'])
    ->name('admin.password.update');
    
Route::get('/admin/activity', [DashboardController::class, 'activity'])
    ->name('admin.activity'); 
    
Route::get('/admin/settings', [DashboardController::class, 'settings'])
    ->name('admin.settings');

Route::post('/admin/settings', [DashboardController::class, 'updateSettings'])
    ->name('admin.settings.update');

Route::get('/admin/announcements', [DashboardController::class, 'announcements'])
    ->name('admin.announcements');

Route::post('/admin/announcements', [DashboardController::class, 'storeAnnouncement'])
    ->name('admin.announcements.store'); 
    
Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])
    ->name('support.index');

Route::post('/support', [App\Http\Controllers\SupportController::class, 'store'])
    ->name('support.store');

Route::get('/admin/support', [DashboardController::class, 'support'])
    ->name('admin.support');
    
Route::post('/admin/support/{id}/resolve', [DashboardController::class, 'resolveSupport'])
    ->name('admin.support.resolve');

Route::post('/admin/support/{id}/delete', [DashboardController::class, 'deleteSupport'])
    ->name('admin.support.delete');   
    
// admin ai questions routes
Route::get('/admin/ai-generator', function() {
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }
    return app()->make(AdminAIQuestionController::class)->index();
})->name('admin.ai.generator');

Route::post('/ai-save', [AdminAIQuestionController::class, 'save'])->name('admin.ai.save');
Route::post('/ai-generate', [AdminAIQuestionController::class, 'generate'])->name('admin.ai.generate'); 

Route::get(
    '/admin/announcements',
    [DashboardController::class, 'announcements']
)->name('admin.announcements');

Route::post(
    '/admin/announcements/store',
    [DashboardController::class, 'storeAnnouncement']
)->name('admin.announcements.store');

Route::post(
    '/admin/announcements/{id}/toggle',
    [DashboardController::class, 'toggleAnnouncement']
)->name('admin.announcements.toggle');

Route::post(
    '/admin/announcements/{id}/delete',
    [DashboardController::class, 'deleteAnnouncement']
)->name('admin.announcements.delete');

Route::get('/admin/question-bank', [AdminAIQuestionController::class, 'admin'])->name('admin.qb');

Route::post('/admin/question-bank/delete/{id}',[AdminAIQuestionController::class, 'delete'])
->name('admin.qb.delete');

Route::get('/admin/subject-topic-record', [DashboardController::class, 'subjectTopicrecord'])
    ->name('admin.subject.topic.record');  

// import topic routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/topics/bulk-upload', [DashboardController::class, 'showUploadForm'])->name('topics.bulk-upload');
    Route::post('/topics/bulk-upload', [DashboardController::class, 'bulkUpload'])->name('topics.bulk-upload.post');
    Route::get('/topics/download-template', [DashboardController::class, 'downloadTemplate'])->name('topics.download-template');
});
            
// admin route ends here   



/*
|--------------------------------------------------------------------------
| School Routes 
|--------------------------------------------------------------------------
*/

// school route starts here
Route::get('/school/students/import', [StudentController::class,'importForm'])
    ->name('school.students.import');

Route::post('/school/students/import', [StudentController::class,'import'])
    ->name('school.students.import.post');

// export credential
Route::get('/school/students/download', [StudentController::class,'downloadCredentials'])
    ->name('school.students.download'); 

Route::get('/school/bulk-payment', [BulkPaymentController::class, 'index'])
    ->name('bulk.payment');

Route::post('/school/bulk-payment/create', [BulkPaymentController::class, 'create'])
    ->name('bulk.payment.create');
    
Route::get('/school/bulk-payment/pay/{id}', [BulkPaymentController::class, 'pay'])
    ->name('bulk.payment.pay');

Route::get('/school/bulk-payment/callback', [BulkPaymentController::class, 'callback'])
    ->name('bulk.payment.callback');

Route::get('/school/bulk-payment/history', [BulkPaymentController::class, 'history'])
    ->name('bulk.payment.history');
    
Route::get('/school/bulk-payment/receipt/{id}', [BulkPaymentController::class, 'receipt'])
    ->name('bulk.payment.receipt');
    
Route::get('/school/bulk-payment/analytics', [BulkPaymentController::class, 'analytics'])
    ->name('bulk.payment.analytics'); 
    
// Route::get('/school/profile', [SchoolController::class, 'profile'])
//     ->name('school.profile');

// Route::post('/school/profile', [SchoolController::class, 'updateProfile'])
//     ->name('school.profile.update');
    
Route::get('/school/results/manage', [SchoolController::class, 'manageResults'])
    ->name('school.results.manage');

Route::post('/school/results/release', [SchoolController::class, 'releaseResults'])
    ->name('school.results.release');
    
Route::get('/school/promotion', [SchoolController::class, 'promotionPage'])
    ->name('school.promotion');

Route::post('/school/promotion/run', [SchoolController::class, 'runPromotion'])
    ->name('school.promotion.run');

Route::get('/school/fees', [SchoolController::class, 'fees'])
    ->name('school.fees');

Route::post('/school/fees', [SchoolController::class, 'saveFees'])
    ->name('school.fees.save');
    
Route::get('/school/fees/{id}/edit', [SchoolController::class, 'editFee'])
    ->name('school.fees.edit');

Route::post('/school/fees/{id}/update', [SchoolController::class, 'updateFee'])
    ->name('school.fees.update');

Route::post('/school/fees/{id}/delete', [SchoolController::class, 'deleteFee'])
    ->name('school.fees.delete');
    
Route::get('/school/books', [SchoolController::class, 'books'])
    ->name('school.books');

Route::post('/school/books', [SchoolController::class, 'saveBooks'])
    ->name('school.books.save');

Route::post('/school/books/{id}/delete', [SchoolController::class, 'deleteBooks'])
    ->name('school.books.delete');
    
Route::get('/school/books/{id}/edit', [SchoolController::class, 'editBooks'])
    ->name('school.books.edit');

Route::post('/school/books/{id}/update', [SchoolController::class, 'updateBooks'])
    ->name('school.books.update');
    
Route::get('/school/results/remarks', [SchoolController::class, 'remarksPage'])
    ->name('school.results.remarks');

Route::post('/school/results/remarks/save', [SchoolController::class, 'saveRemarks'])
    ->name('school.results.remarks.save');

Route::get('/school/fees/payments', [SchoolController::class, 'feePayments'])
    ->name('school.fees.payments');

Route::post('/school/fees/payments/{id}/confirm', [SchoolController::class, 'confirmFeePayment'])
    ->name('school.fees.payments.confirm');   
    
Route::get('school/classes', [App\Http\Controllers\School\SchoolClassController::class, 'index'])->name('classes.index');
Route::get('school/classes/create', [App\Http\Controllers\School\SchoolClassController::class, 'create'])->name('classes.create');
Route::post('school/classes', [App\Http\Controllers\School\SchoolClassController::class, 'store'])->name('classes.store');
Route::delete('school/classes/{id}', [App\Http\Controllers\School\SchoolClassController::class, 'destroy'])->name('classes.destroy');
Route::get('school/classes/available', [App\Http\Controllers\School\SchoolClassController::class, 'getAvailableClasses'])->name('classes.available'); 

Route::middleware(['auth'])->prefix('school')->name('school.')->group(function () {
    Route::get('/dashboard', [SchoolController::class, 'dashboard'])->name('dashboard');
    // other school routes...
});

Route::get('/school/students/download-page', [StudentController::class,'downloadPage'])
    ->name('school.students.download.page');

// face recognition handled by school  
Route::get('/school/student/face/register/{id}', [AttendanceController::class, 'schoolFaceRegisterForm'])
    ->name('school.face.register');
Route::post('/school/student/face/register/{id}', [AttendanceController::class, 'schoolSaveFace'])
    ->name('school.face.save');
Route::get('school/attendance/face-scan', [AttendanceController::class, 'schoolFaceScan'])
    ->name('school.attendance.face.scan');
Route::get('/school/students/face-registration', [AttendanceController::class, 'schoolStudentFaceList'])
    ->name('school.students.face.list');  
    
// Teacher Subject Management Routes
Route::get('/school/teacher-subjects', [TeacherSubjectController::class, 'index'])->name('school.teacher-subjects.index');
Route::get('school/teacher-subjects/create', [TeacherSubjectController::class, 'create'])->name('school.teacher-subjects.create');
Route::post('/school/teacher-subjects', [TeacherSubjectController::class, 'store'])->name('school.teacher-subjects.store');
Route::put('/school/teacher-subjects/{id}/toggle', [TeacherSubjectController::class, 'toggle'])->name('school.teacher-subjects.toggle');
Route::delete('/school/teacher-subjects/{id}', [TeacherSubjectController::class, 'destroy'])->name('school.teacher-subjects.destroy');

Route::get('/school/profile', [SchoolController::class, 'profile'])
    ->name('school.profile');    

Route::post('/school/profile', [SchoolController::class, 'updateProfile'])
    ->name('school.profile.update');

Route::get('/school/password', [SchoolController::class, 'password'])
    ->name('school.password');

Route::post('/school/password', [SchoolController::class, 'updatePassword'])
    ->name('school.password.update');

Route::get('/school/activity', [SchoolController::class, 'activity'])
    ->name('school.activity');

Route::get('/school/finance-dashboard', [PaymentController::class, 'financeDashboard'])
    ->name('school.finance.dashboard');  
    
Route::get('/school/students', [SchoolController::class, 'students'])
    ->name('school.students');

Route::get('/school/student/{id}/edit', [SchoolController::class, 'editStudent'])
    ->name('school.student.edit');

Route::post('/school/student/{id}/update', [SchoolController::class, 'updateStudent'])
    ->name('school.student.update');

Route::post('/school/student/{id}/delete', [SchoolController::class, 'deleteStudent'])
    ->name('school.student.delete');

Route::post('/school/student/{id}/toggle', [SchoolController::class, 'toggleStudent'])
    ->name('school.student.toggle');

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/school/teachers',
        [SchoolController::class, 'teachers']
    )->name('school.teachers');

    Route::get(
        '/school/teacher/{id}/edit',
        [SchoolController::class, 'editTeacher']
    )->name('school.teacher.edit');

    Route::post(
        '/school/teacher/{id}/update',
        [SchoolController::class, 'updateTeacher']
    )->name('school.teacher.update');

    Route::post(
        '/school/teacher/{id}/toggle',
        [SchoolController::class, 'toggleTeacher']
    )->name('school.teacher.toggle');

    Route::post(
        '/school/teacher/{id}/delete',
        [SchoolController::class, 'deleteTeacher']
    )->name('school.teacher.delete');

});

Route::get('/school/questions', [SchoolController::class, 'questions'])->name('school.questions');

Route::post('/school/question/approve/{id}', [SchoolController::class, 'approve'])->name('school.question.approve');

Route::post('/school/question/delete/{id}', [SchoolController::class, 'delete'])->name('school.question.delete');

Route::post(
    '/school/questions/bulk-approve',
    [SchoolController::class, 'bulkApprove']
)->name('school.question.bulkApprove');

// School Notifications
Route::middleware(['auth'])->prefix('school')->name('school.')->group(function () {
    
});

Route::get('/notifications/create', [SchoolController::class, 'showNotificationForm'])
        ->name('notifications.create');
    Route::post('/notifications/send', [SchoolController::class, 'sendNotification'])
        ->name('notifications.send');
    
// school route ends here 



/*
|--------------------------------------------------------------------------
| Teacher Routes 
|--------------------------------------------------------------------------
*/

// teacher's routes start here
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
});

// teacher import questions
Route::post('/teacher/bank-preview', [QuestionBankController::class, 'generatePreview'])
    ->name('teacher.bank.preview');

Route::post('/teacher/save', [QuestionBankController::class, 'save'])
    ->name('teacher.question.save');    

Route::get('/teacher/ai-generator', function() {
    if (auth()->user()->role !== 'teacher') {
        abort(403, 'Unauthorized');
    }
    return app()->make(QuestionBankController::class)->index();
})->name('teacher.ai.generator');    

Route::post('/teacher/ai-save', [App\Http\Controllers\AIQuestionController::class, 'save'])
    ->name('teacher.ai.save');

Route::post('/teacher/ai-generate', [App\Http\Controllers\AIQuestionController::class, 'generate'])
    ->name('teacher.ai.generate');

// class -> subject route
Route::get('/get-subjects/{classId}', function ($classId) {
    return \App\Models\Subject::whereIn('id', function ($query) use ($classId) {
        $query->select('subject_id')
              ->from('class_subjects')
              ->where('class_level_id', $classId);
    })->get();
});

// subject -> topic route
Route::get('/get-topics/{classId}/{subjectId}', function ($classId, $subjectId) {
    return \App\Models\Topic::where('class_level_id', $classId)
        ->where('subject_id', $subjectId)
        ->get();
});

Route::get('/teacher/results/create', [ResultController::class, 'create'])->name('results.create');
Route::post('/teacher/results/store', [ResultController::class, 'store'])->name('results.store');

// attendance
Route::middleware('auth')->group(function () {

    Route::get('/teacher/attendance/dashboard', [AttendanceController::class, 'dashboard'])
        ->name('attendance.dashboard');
});

// Route::get('/teacher/attendance/dashboard', [AttendanceController::class, 'dashboard'])->name('attendance.dashboard');
Route::get('teacher/attendance/scan', [AttendanceController::class, 'scan'])->name('attendance.scan');
Route::post('teacher/attendance/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');
Route::get('/teacher/attendance/report/pdf', [AttendanceController::class, 'pdf'])->name('attendance.pdf');

Route::middleware(['auth'])->prefix('school')->group(function(){
    Route::get('/teacher/create',[TeacherController::class,'create'])->name('school.teacher.create');
    Route::post('/teacher/store',[TeacherController::class,'store'])->name('school.teacher.store');
});

// face recognition handled by teacher    
Route::get('/teacher/student/face/register/{id}', [AttendanceController::class, 'faceRegisterForm'])->name('face.register');
Route::post('/teacher/student/face/register/{id}', [AttendanceController::class, 'saveFace'])->name('face.save');
Route::get('teacher/attendance/face-scan', [AttendanceController::class, 'faceScan'])
    ->name('attendance.face.scan');
Route::get('/teacher/students/face-registration', [AttendanceController::class, 'studentFaceList'])
    ->name('students.face.list');

Route::middleware(['auth'])->prefix('school')->group(function(){
    Route::get('/student/create',[StudentController::class,'create'])
        ->name('school.student.create');
    Route::post('/student/store',[StudentController::class,'store'])
        ->name('school.student.store');
});

// questions creation route
Route::get('/teacher/questions/create', [QuestionController::class, 'create'])
    ->name('teacher.questions.create');

// questions upload route    
Route::post('/teacher/questions/store', [QuestionController::class, 'store'])
    ->name('teacher.questions.store');

// exams creation route    
Route::get('/teacher/exams/create', [\App\Http\Controllers\Teacher\ExamController::class, 'create'])
    ->name('teacher.exams.create');

// exams upload route    
Route::post('/teacher/exams/store', [\App\Http\Controllers\Teacher\ExamController::class, 'store'])
    ->name('teacher.exams.store');

Route::get('/teacher/profile', [TeacherController::class, 'profile'])
    ->name('teacher.profile');

Route::post('/teacher/profile', [TeacherController::class, 'updateProfile'])
    ->name('teacher.profile.update');   
    
Route::get('/teacher/password', [TeacherController::class, 'password'])
    ->name('teacher.password');

Route::post('/teacher/password', [TeacherController::class, 'updatePassword'])
    ->name('teacher.password.update');
    
Route::get('/teacher/activity', [TeacherController::class, 'activity'])
    ->name('teacher.activity');  
    
Route::get('/teacher/questions', [TeacherController::class, 'myQuestions'])->name('teacher.questions');

Route::post('/teacher/question/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.question.delete');  

Route::get(
    '/teacher/exam-paper',
    [App\Http\Controllers\Teacher\QuestionController::class, 'examPaper']
)->name('teacher.exam.paper');

Route::get(
    '/teacher/exam-paper/pdf',
    [App\Http\Controllers\Teacher\QuestionController::class, 'downloadPdf']
)->name('teacher.exam.paper.pdf');

Route::get('/teacher/answer-sheet', [QuestionController::class, 'answerSheet'])
    ->name('teacher.answer.sheet');

Route::get('/teacher/students', [TeacherController::class, 'students'])
    ->name('teacher.students');  
    
Route::get('/get-topics/{subjectId}', [TopicController::class, 'getTopicsBySubject'])
    ->name('get.topics');    

// Teacher Notifications
// routes/web.php

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    // ... existing routes
    Route::get('/notifications/create', [TeacherController::class, 'showNotificationForm'])
        ->name('notifications.create');
    Route::post('/notifications/send', [TeacherController::class, 'sendNotification'])
        ->name('notifications.send');
});

// teacher's route ends here 


/*
|--------------------------------------------------------------------------
| Student Routes 
|--------------------------------------------------------------------------
*/

// students routes start here
Route::middleware([
    'auth',
    \App\Http\Middleware\EnsureStudentAccess::class
])->group(function () {

    // =================================
    // EXAMS
    // =================================

    Route::get('/student/analytics', [\App\Http\Controllers\Student\ExamController::class, 'analytics'])
    ->name('student.analytics');

// qr code    
Route::get('/student/{id}/qrcode', [QRcodeController::class, 'qr'])->name('student.qrcode');

    // exam route
    Route::get('/exam/start/{examId}', [ExamController::class, 'start'])
        ->name('student.exam.start');
        
    // available exams route
    Route::get('/student/student/exams',[ExamController::class, 'available'])
    ->name('student.exams.available');    
        
    // exam questions route
    Route::get('/student/exam/question', [ExamController::class, 'question'])
        ->name('student.exam.question');

    Route::post('/student/exam/answer', [ExamController::class, 'answer'])
        ->name('student.exam.answer');

    Route::get('/student/exam/result/{id}', [\App\Http\Controllers\Student\ExamController::class, 'result'])
        ->name('student.exam.result');      

    // auto submition route
    Route::get('/student/exam/submit-auto', [ExamController::class, 'autoSubmit'])
        ->name('student.exam.submit.auto');
        
    // leaderboard
    Route::get('student/leaderboard', [App\Http\Controllers\Student\LeaderboardController::class, 'index'])
        ->name('student.leaderboard');

    // download result    
    Route::get('/exam/result/{id}/pdf', [ExamController::class, 'downloadResult'])
        ->name('student.exam.pdf');

    // auto-populate subjects    
    Route::get('/get-subjects/{classId}', function ($classId) {

        return \App\Models\Subject::whereIn('id', function ($query) use ($classId) {
            $query->select('subject_id')
                ->from('topics')
                ->where('class_level_id', $classId);
        })->get();
    });

    // get topic route
    Route::get('/get-topics/{subjectId}', function ($subjectId) {
        return \App\Models\Topic::where('subject_id', $subjectId)->get();
    });
    
    Route::get('/results', [StudentController::class, 'results'])
        ->name('results');
    
    Route::get('/exam/{exam}/take', [StudentController::class, 'takeExam'])
        ->name('exam.take');

    // result checker
    Route::get('/student/check-result', [ResultController::class, 'checker'])->name('results.checker');
    Route::post('/student/check-result', [ResultController::class, 'showResult'])->name('results.show');

    // correction route
    Route::get('/exam/review/{id}', [ExamController::class, 'review'])
        ->name('student.exam.review');

    Route::get('/student/profile', [StudentController::class, 'profile'])
        ->name('student.profile');

    Route::post('/student/profile', [StudentController::class, 'updateProfile'])
        ->name('student.profile.update');      
        
    Route::get('/student/change-password', [StudentController::class, 'changePassword'])
        ->name('student.password');

    Route::post('/student/change-password', [StudentController::class, 'updatePassword'])
        ->name('student.password.update');
        
    Route::get('/student/activity-log', [StudentController::class, 'activityLog'])
        ->name('student.activity');  
        
    Route::get('/student/email-activate', [PaymentController::class, 'emailActivate'])
        ->name('student.email.activate');

    Route::get('/student/email-disable', [PaymentController::class, 'emailDisable'])
        ->name('student.email.disable');

    Route::get('/student/school-fees', [PaymentController::class, 'schoolFees'])
        ->name('student.school.fees');

    Route::post('/student/school-fees', [PaymentController::class, 'submitSchoolFees'])
        ->name('student.school.fees.submit');    

    Route::get('/student/fees-receipt/{id}', [PaymentController::class, 'feesReceipt'])
        ->name('student.fees.receipt'); 
        
    Route::get('/student/fees-history', [PaymentController::class, 'feesHistory'])
        ->name('student.fees.history');
        
    // Route::get('/student/exams', [ExamController::class,'index']);
    Route::get('/student/exam/{id}', [ExamController::class,'start']);
    Route::post('/student/exam/submit', [ExamController::class,'submit']);
    
    Route::get(
    '/student/practice',
    [StudentController::class, 'practicePage']
    )->name('student.practice');

    Route::post(
        '/student/practice/start',
        [StudentController::class, 'startPractice']
    )->name('student.practice.start');

    Route::get(
        '/student/practice/dashboard',
        [StudentController::class, 'practiceDashboard']
    )->name('student.practice.dashboard');

    Route::get(
        '/student/result/pdf',
        [ResultController::class, 'downloadPdf']
    )->name('student.result.pdf');

    Route::get(
        '/student/save-question/{id}',
        [ExamController::class, 'toggleSave']
    )->name('student.save.question');

    Route::get(
        '/student/saved-questions',
        [ExamController::class, 'savedQuestions']
    )->name('student.saved.questions');

    Route::get(
        '/student/weak-topics',
        [ExamController::class, 'weakTopics']
    )->name('student.weak.topics');



    Route::delete(
        '/student/save-question/{id}',
        [ExamController::class, 'removeSavedQuestion']
    )->name('student.save-question.remove');

  

});

// block external students
Route::middleware([
    'auth',
    \App\Http\Middleware\BlockExternal::class
])->group(function () {

    Route::get('/student/{id}/qrcode', [QRcodeController::class, 'qr'])->name('student.qrcode');

    Route::post('/student/school-fees', [PaymentController::class, 'submitSchoolFees'])
    ->name('student.school.fees.submit');  

    Route::get('/student/fees-history', [PaymentController::class, 'feesHistory'])
        ->name('student.fees.history'); 

    Route::get('/student/check-result', [ResultController::class, 'checker'])
        ->name('results.checker');

    Route::get('student/leaderboard', [App\Http\Controllers\Student\LeaderboardController::class, 'index'])
        ->name('student.leaderboard'); 
        
    Route::get('/exam/result/{id}', [\App\Http\Controllers\Student\ExamController::class, 'result'])
    ->name('student.exam.result');   
    
    Route::get('/student/email-activate', [PaymentController::class, 'emailActivate'])
    ->name('student.email.activate');

});

// external student routes
Route::middleware(['auth', 'ensure.external.class'])->group(function () {

    Route::get('/student/exams', [ExamController::class,'index']);

    Route::get('/student/exam/{id}', [ExamController::class,'start']);

    Route::post('/student/exam/submit', [ExamController::class,'submit']);

});

Route::middleware('auth')->group(function () {

    Route::get('/external/select-class', [StudentController::class, 'showClassForm'])
        ->name('external.class.select');

    Route::post('/external/select-class', [StudentController::class, 'saveClass'])
        ->name('external.class.save');

    Route::get('/student/student/exams', [ExamController::class, 'available'])
    ->name('student.exams.available');
    
    // exam questions route
    Route::get('/student/exam/question', [ExamController::class, 'question'])
        ->name('student.exam.question');

    Route::post('/student/exam/answer', [ExamController::class, 'answer'])
        ->name('student.exam.answer');

    Route::get('/student/exam/result/{id}', [\App\Http\Controllers\Student\ExamController::class, 'result'])
        ->name('student.exam.result');      

    // auto submition route
    Route::get('/student/exam/submit-auto', [ExamController::class, 'autoSubmit'])
        ->name('student.exam.submit.auto');
        
    Route::get('/student/practice', [ExamController::class, 'externalPracticeDashboard'])
    ->name('external.student.practice.dashboard');
    
    Route::get('/get-topics/{subjectId}', function ($subjectId) {
        return \App\Models\Topic::where('subject_id', $subjectId)->get();
    });

    Route::get('/student/practice/start', [ExamController::class, 'startPractice'])
    ->name('student.practice.start');

    Route::get('/student/practice/question', [ExamController::class, 'showQuestion'])
    ->name('student.show.question');

    Route::get('/student/practice', [ExamController::class, 'practiceDashboard'])
        ->name('student.practice.page');
    

    // In routes/web.php
    Route::get('/student/external/practice', [ExamController::class, 'startPractice'])
    ->name('student.external.practice.show');

});

// student route ends here    



/*
|--------------------------------------------------------------------------
| Referrer Routes 
|--------------------------------------------------------------------------
*/

// referral route
Route::get('/referrer/dashboard', [ReferrerController::class, 'dashboard'])
    ->middleware('auth')
    ->name('referrer.dashboard');

Route::get('/referrer/withdraw', [ReferrerController::class, 'withdrawForm'])
    ->name('referrer.withdraw');

Route::post('/referrer/withdraw', [ReferrerController::class, 'submitWithdraw'])
    ->name('referrer.withdraw.submit');
    
Route::get('/referrer/profile', [ReferrerController::class, 'profile'])
    ->name('referrer.profile');

Route::post('/referrer/profile', [ReferrerController::class, 'updateProfile'])
    ->name('referrer.profile.update');   
    
Route::get('/referrer/password', [ReferrerController::class, 'password'])
    ->name('referrer.password');

Route::post('/referrer/password', [ReferrerController::class, 'updatePassword'])
    ->name('referrer.password.update');
    
Route::get('/referrer/activity', [ReferrerController::class, 'activity'])
    ->name('referrer.activity');  

Route::get('/referrer/withdraw-history', [ReferrerController::class, 'withdrawHistory'])
    ->name('referrer.withdraw.history');
    
Route::get('/referrer/analytics', [ReferrerController::class, 'analytics'])
    ->name('referrer.analytics');
    
Route::get('/referrer/settings', [ReferrerController::class, 'settings'])
    ->name('referrer.settings');

Route::post('/referrer/settings', [ReferrerController::class, 'updateSettings'])
    ->name('referrer.settings.update');

// referrer route ends here    

// Authentication routes (from Breeze)
require __DIR__.'/auth.php';