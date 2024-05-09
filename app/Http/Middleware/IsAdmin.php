<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Redirect to dashboard with error message if not authorized
        return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
    }
}