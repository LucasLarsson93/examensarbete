<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Redirect to dashboard with error message if not authorized
        return redirect()->route('dashboard')->with('error', 'You are not authorized to access this page.');
    }
}
