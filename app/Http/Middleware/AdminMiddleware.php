<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated as an admin
        if (!auth('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
