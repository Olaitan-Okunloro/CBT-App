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
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\LeaderboardController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\QuestionBankController;
use App\Http\Controllers\AIQuestionController;
use App\Http\Controllers\Admin\AdminAIQuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (MUST PAY)
|--------------------------------------------------------------------------
*/

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

Route::get('/admin/analytics', [DashboardController::class, 'analytics'])
            ->name('dashboard.leaderboard');   

//  bulk students upload
Route::get('/school/students/import', [StudentController::class,'importForm'])
    ->name('school.students.import');

Route::post('/school/students/import', [StudentController::class,'import'])
    ->name('school.students.import.post');

// export credential
Route::get('/school/students/download', [StudentController::class,'downloadCredentials'])
    ->name('school.students.download'); 





// teacher's routes start here

// Teacher dashboard  
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
});

// teacher import questions
Route::post('/teacher/bank-preview', [QuestionBankController::class, 'generatePreview'])
    ->name('teacher.bank.preview');

Route::get('/teacher/ai-generator', function() {
    if (auth()->user()->role !== 'teacher') {
        abort(403, 'Unauthorized');
    }
    return app()->make(AIQuestionController::class)->index();
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

// Route::get('/teacher/question-bank', [QuestionBankController::class, 'index'])
//     ->name('teacher.question.bank');

// Route::post('/teacher/question-bank/import', [QuestionBankController::class, 'import'])
//     ->name('teacher.question.bank.import');

// teacher generate question
// Route::post('/teacher/question-bank/generate', [QuestionBankController::class, 'generateFromBank'])
//     ->name('teacher.bank.generate');    

// teacher's route ends here 

// students routes start here
Route::get('/student/analytics', [\App\Http\Controllers\Student\ExamController::class, 'analytics'])
    ->name('student.analytics');

// School dashboard
Route::middleware(['auth'])->prefix('school')->name('school.')->group(function () {
    Route::get('/dashboard', [SchoolController::class, 'dashboard'])->name('dashboard');
    // other school routes...
});

Route::get('/school/students/download-page', [StudentController::class,'downloadPage'])
    ->name('school.students.download.page');

// exam route
Route::get('/exam/start/{examId}', [ExamController::class, 'start'])
    ->name('student.exam.start');
    
// available exams route
Route::get('/student/exams', [ExamController::class, 'available'])
    ->name('student.exams.available');
    
// exam questions route
Route::get('/exam/question', [ExamController::class, 'question'])
    ->name('student.exam.question');

Route::post('/exam/answer', [ExamController::class, 'answer'])
    ->name('student.exam.answer');

Route::get('/exam/result/{id}', [\App\Http\Controllers\Student\ExamController::class, 'result'])
    ->name('student.exam.result');    

// auto submition route
Route::get('/exam/submit-auto', [ExamController::class, 'autoSubmit'])
    ->name('student.exam.submit.auto');
    
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

// leaderboard
Route::get('student/leaderboard', [App\Http\Controllers\Student\LeaderboardController::class, 'index'])
    ->name('student.leaderboard');

// download result    
Route::get('/exam/result/{id}/pdf', [ExamController::class, 'downloadResult'])
    ->name('student.exam.pdf');    

// teacher ai questions routes


// admin ai questions routes
Route::get('/admin/ai-generator', function() {
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }
    return app()->make(AdminAIQuestionController::class)->index();
})->name('admin.ai.generator');

Route::post('/ai-save', [AdminAIQuestionController::class, 'save'])->name('admin.ai.save');
Route::post('/ai-generate', [AdminAIQuestionController::class, 'generate'])->name('admin.ai.generate');

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

// routes one ends here    

// Single dynamic dashboard route
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');    

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

// Teacher Subject Management Routes
Route::get('/teacher-subjects', [TeacherSubjectController::class, 'index'])->name('teacher-subjects.index');
    Route::get('/teacher-subjects/create', [TeacherSubjectController::class, 'create'])->name('teacher-subjects.create');
    Route::post('/teacher-subjects', [TeacherSubjectController::class, 'store'])->name('teacher-subjects.store');
    Route::put('/teacher-subjects/{id}/toggle', [TeacherSubjectController::class, 'toggle'])->name('teacher-subjects.toggle');
    Route::delete('/teacher-subjects/{id}', [TeacherSubjectController::class, 'destroy'])->name('teacher-subjects.destroy');
Route::middleware(['auth', 'role:school'])->prefix('school')->name('school.')->group(function () {
    // Teacher Subjects
    
});


// School Classes Routes - Use correct namespace
Route::get('school/classes', [App\Http\Controllers\School\SchoolClassController::class, 'index'])->name('classes.index');
Route::get('school/classes/create', [App\Http\Controllers\School\SchoolClassController::class, 'create'])->name('classes.create');
Route::post('school/classes', [App\Http\Controllers\School\SchoolClassController::class, 'store'])->name('classes.store');
Route::delete('school/classes/{id}', [App\Http\Controllers\School\SchoolClassController::class, 'destroy'])->name('classes.destroy');
Route::get('school/classes/available', [App\Http\Controllers\School\SchoolClassController::class, 'getAvailableClasses'])->name('classes.available');
// Route::middleware(['auth'])->prefix('school')->name('school.')->group(function () {
// });

// Student routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Route::get('/exams/available', [ExamController::class, 'start'])
    //     ->name('exams.available');        
    
    Route::get('/results', [StudentController::class, 'results'])
        ->name('results');
    
    Route::get('/exam/{exam}/take', [StudentController::class, 'takeExam'])
        ->name('exam.take');
});

// correction route
Route::get('/exam/review/{id}', [ExamController::class, 'review'])
    ->name('student.exam.review');

// student route ends here    

// exam route
Route::middleware(['auth','paid'])->group(function () {

    Route::get('/exams', [ExamController::class,'index']);
    Route::get('/exam/{id}', [ExamController::class,'start']);
    Route::post('/exam/submit', [ExamController::class,'submit']);

});

// Profile routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// teacher route
Route::middleware(['auth'])->prefix('school')->group(function(){
    Route::get('/teacher/create',[TeacherController::class,'create'])->name('school.teacher.create');
    Route::post('/teacher/store',[TeacherController::class,'store'])->name('school.teacher.store');
});

// student route
Route::middleware(['auth'])->prefix('school')->group(function(){
    Route::get('/student/create',[StudentController::class,'create'])
        ->name('school.student.create');
    Route::post('/student/store',[StudentController::class,'store'])
        ->name('school.student.store');
});

// Paystack webhook (no CSRF protection)
Route::post('/payment/webhook', [PaymentController::class, 'webhook'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('payment.webhook');

Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

Route::middleware(['auth'])->prefix('teacher')->group(function(){

    // Route::get('/questions/create',[QuestionController::class,'create'])
    // ->name('teacher.questions.create');

    // Route::post('/questions/store',[QuestionController::class,'store'])
    // ->name('teacher.questions.store');

});

// Authentication routes (from Breeze)
require __DIR__.'/auth.php';