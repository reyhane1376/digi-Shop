<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        // if (!$request->user()->hasRole($role) && $permission == null) {
        //     abort(403);
        // }
        if (!$request->user()->hasRole($role)) {
            abort(403);
        }

        if ($permission !== null && !$request->user()->can($permission)) {
            abort(403);
        }
        return $next($request);
    }
}
