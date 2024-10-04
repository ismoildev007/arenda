<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class clientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('client')->check() && (auth()->guard('client')->user()->inn || auth()->guard('client')->user()->pinfl)) {
            return $next($request);
        }
        return abort(403, 'Unauthorized');
    }
}
