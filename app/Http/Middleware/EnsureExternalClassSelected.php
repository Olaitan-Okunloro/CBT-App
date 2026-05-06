<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureExternalClassSelected
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->exam_type === 'EXTERNAL') {

            // support both storage options
            $classId = $user->class_id ?? $user->studentDetail?->class_id;

            if (!$classId) {
                return redirect()->route('external.class.select');
            }
        }

        return $next($request);
    }
}