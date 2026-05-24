<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // Check if user is admin
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Check if alumni account is approved
        if ($user->status !== 'approved') {
            Auth::logout();
            
            // Store a flag in session to show the popup
            return redirect()->route('login')->with('unverified', 'Your account is pending approval. Please wait for admin confirmation.');
        }

        // Alumni redirect
        return redirect()->intended(route('alumni.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}