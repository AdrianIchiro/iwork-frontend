<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmployer
{
    public function handle(Request $request, Closure $next)
    {
        if (strtoupper(session('user')['role']) !== 'EMPLOYER') {
            abort(403);
        }

        return $next($request);
    }
}
