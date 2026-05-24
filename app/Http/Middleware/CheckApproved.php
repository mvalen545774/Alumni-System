<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->isApproved() && !auth()->user()->isAdmin()) {
            auth()->logout();
            return redirect('/login')->with('error', 'Your account is pending approval. Please wait for admin confirmation.');
        }
        return $next($request);
    }
}