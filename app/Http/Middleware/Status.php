<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->status === 0) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account is currently disabled. Please contact your supervisor to facilitate the activation process and gain access to your account.');
        }

        return $next($request);
    }
}
