<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\School\TeacherController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Teacher\QuestionController;
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
});

//  bulk students upload
Route::get('/school/students/import', [StudentController::class,'importForm'])
    ->name('school.students.import');

Route::post('/school/students/import', [StudentController::class,'import'])
    ->name('school.students.import.post');

// export credential
Route::get('/school/students/download', [StudentController::class,'downloadCredentials'])
    ->name('school.students.download');    

// Teacher dashboard  
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    // other teacher routes...
});

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

// auto submition route
Route::get('/exam/submit-auto', [ExamController::class, 'submitAuto'])
    ->name('student.exam.submit.auto');
    
// questions upload route
Route::get('/teacher/questions/create', [QuestionController::class, 'create'])
    ->name('teacher.questions.create');

Route::post('/teacher/questions/store', [QuestionController::class, 'store'])
    ->name('teacher.questions.store');    

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

// Student routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Route::get('/exams/available', [ExamController::class, 'start'])
    //     ->name('exams.available');        
    
    Route::get('/results', [StudentController::class, 'results'])
        ->name('results');
    
    Route::get('/exam/{exam}/take', [StudentController::class, 'takeExam'])
        ->name('exam.take');
});

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