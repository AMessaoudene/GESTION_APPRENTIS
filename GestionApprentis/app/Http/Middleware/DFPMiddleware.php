<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class DFPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has 'DFP' role
        if (Auth::check() && Auth::user()->role === 'DFP') {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}
