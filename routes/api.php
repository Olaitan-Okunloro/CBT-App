<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/paystack/webhook', [PaymentController::class, 'webhook'])
    ->name('paystack.webhook');