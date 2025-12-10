<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('token') && session()->has('user')) {

            $user = session('user');

            if ($user['role'] === 'EMPLOYER' && $request->routeIs('employer.dashboard')) {
                return $next($request);
            }

            if ($user['role'] === 'WORKER' && $request->routeIs('main.quest')) {
                return $next($request);
            }

            switch ($user['role']) {
                case 'EMPLOYER':
                    return redirect()->route('employer.dashboard');

                case 'WORKER':
                    return redirect()->route('main.quest');

                default:
                    return redirect('/');
            }
        }

        return $next($request);
    }
}
