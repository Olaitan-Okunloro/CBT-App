<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPaymentStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $student = $user->studentDetail;

        // If user has never paid
        if (!$student || !$student->has_paid) {

            return redirect()->route('payment.index')
                ->with('error','You must complete payment first.');
        }

        // If payment expired
        if ($student->payment_expiry < now()) {

            return redirect()->route('payment.index')
                ->with('error','Your subscription has expired. Please renew.');
        }

        return $next($request);
    }
}
