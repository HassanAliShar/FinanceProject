<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasRight
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
        if($request->user()->hasRight($request->route()->getName()))
            return $next($request);
    }
}
