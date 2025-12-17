<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureWorker
{
    public function handle(Request $request, Closure $next)
    {
        if (strtoupper(session('user')['role']) !== 'WORKER') {
            abort(403);
        }

        return $next($request);
    }
}
