<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPayment
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Allow payment routes
        if ($request->routeIs('payment.*')) {
            return $next($request);
        }

        // Only students must pay
        if (strtolower($user->role) === 'student') {

            $student = $user->studentDetail;

            if (!$student || !$student->has_paid) {
                return redirect()->route('payment.show')
                    ->with('error','Please complete payment.');
            }

            if ($student->payment_expiry && $student->payment_expiry < now()) {
                return redirect()->route('payment.show')
                    ->with('error','Subscription expired.');
            }
        }

        return $next($request);
    }
}