<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Env;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request..
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info('Login Request Received', $request->all());
    
        // Check if signing in as a guest
        if ($request->has('guest')) {
            $guestUserId = env('GUEST_USER_ID', 125);
            Log::info("Guest login detected, attempting to log in user ID: {$guestUserId}");
    
            // Attempt login
            if (Auth::loginUsingId($guestUserId)) {
                Log::info("Guest login successful for user ID: {$guestUserId}");
    
                // Mark guest user as online
                $guestUser = Auth::user();
                if ($guestUser) {
                    Log::info("Guest user found: {$guestUser->id}");
                    $guestUser->is_online = true;
                    $guestUser->update();
                    Log::info("Guest user marked as online.");
                } else {
                    Log::error("Auth::user() returned null after guest login.");
                }
    
                return redirect()->route('dashboard');
            } else {
                Log::error("Guest login failed for user ID: {$guestUserId}");
            }
        }
    
        // Standard authentication
        Log::info("Attempting standard login.");
        $request->authenticate();
        Log::info("Standard login successful.");
    
        $request->session()->regenerate();
        Log::info("Session regenerated.");
    
        // Mark authenticated user as online
        $user = Auth::user();
        if ($user) {
            Log::info("Authenticated user found: {$user->id}");
            $user->is_online = true;
            $user->update();
            Log::info("Authenticated user marked as online.");
        } else {
            Log::error("Auth::user() returned null after standard login.");
        }
    
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $user = Auth::guard('web')->user();
    
        if ($user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['is_online' => 0]);
        }
    
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info("User logged out and redirected.");

        return redirect()->route('welcome'); 
    }
}
