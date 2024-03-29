<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenbMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('tokenb') === env('tokenb')) {
            return $next($request);
        } else {
            return response()->json(['status' => 'error', 'meta' => null, 'data' => null], 401);
        }
    }
}
