<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('UpdateLastActivity middleware triggered!');

        if (Auth::check()) {
            Log::info('User is authenticated: ' . Auth::user()->id);
            Auth::user()->update(['last_activity' => now()]);
        } else {
            Log::info('User is not authenticated.');
        }

        return $next($request);
    }
}
