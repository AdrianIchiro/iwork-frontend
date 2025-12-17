<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('token') && session()->has('user')) {
            $role = strtoupper(session('user')['role']);

            return match ($role) {
                'EMPLOYER' => redirect()->route('employer.index'),
                'WORKER'   => redirect()->route('main.index'),
                default    => redirect('/'),
            };
        }
        return $next($request);
    }
}
