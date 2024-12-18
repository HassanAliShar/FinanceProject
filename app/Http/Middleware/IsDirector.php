<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDirector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user() != null && $request->user()->role_id == getDirectorRoleId())
            return $next($request);

        abort(401);
    }
}
