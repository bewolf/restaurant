<?php

namespace App\Http\Middleware;

use Closure;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Need refactor for manager role
        if (auth()->user()->username == 'manager') {
            return $next($request);
        }
        return back()->with('error', 'Unauthorised');
    }
}
