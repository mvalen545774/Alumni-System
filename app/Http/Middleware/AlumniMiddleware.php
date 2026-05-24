<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlumniMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'alumni') {
            abort(403, 'Unauthorized - Alumni access only');
        }
        return $next($request);
    }
}