<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockExternal
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // If user is external (EXTERNAL), block access
        if ($user && $user->exam_type === 'EXTERNAL') {

            abort(403, 'Access restricted for external students.');
        }

        return $next($request);
    }
}