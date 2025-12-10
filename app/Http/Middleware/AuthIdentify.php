<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthIdentify
{
     public function handle(Request $request, Closure $next)
    {
        if (!session()->has('token') || !session()->has('user')) {
            return redirect()->route('login.show')->withErrors([
                'auth_error' => 'Silakan login terlebih dahulu.'
            ]);
        }

        return $next($request);
    }
}
