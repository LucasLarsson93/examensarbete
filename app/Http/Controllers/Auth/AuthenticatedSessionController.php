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
        // Check if signing in as a guest
        if ($request->has('guest')) {
            $guestUserId = env('GUEST_USER_ID', 1);
            Log::info(env('GIT_USERNAME'));
            Log::info("Guest login detected, attempting to log in user ID {$guestUserId}");
            Auth::loginUsingId($guestUserId);
    
            // Mark guest user as online
            $guestUser = Auth::user();
            if ($guestUser) {
                $guestUser->is_online = true;
                $guestUser->update();
            }
    
            return redirect()->route('dashboard');
        }
    
        // Standard authentication
        $request->authenticate();
        $request->session()->regenerate();
    
        // Mark authenticated user as online
        $user = Auth::user();
        if ($user) {
            $user->is_online = true;
            $user->update();
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
