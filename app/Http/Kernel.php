<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware aliases.
     */
    protected $middlewareAliases = [

        'auth' => \App\Http\Middleware\Authenticate::class,

        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'paid' => \App\Http\Middleware\CheckPayment::class,

        'role' => \App\Http\Middleware\CheckRole::class,

    ];
}