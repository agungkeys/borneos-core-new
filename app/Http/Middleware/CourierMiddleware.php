<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierMiddleware
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
      if (Auth::guard('courier')->check()) {
          if(!auth('courier')->user()->status)
          {
              auth()->guard('courier')->logout();
              return redirect()->route('courier.auth.login');
          }
          return $next($request);
      }
      return redirect()->route('courier.auth.login');
    }
}
