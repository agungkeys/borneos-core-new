<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantMiddleware
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
      if (Auth::guard('merchant')->check()) {
          if(!auth('merchant')->user()->status)
          {
              auth()->guard('merchant')->logout();
              return redirect()->route('merchant.auth.login');
          }
          return $next($request);
      }
      return redirect()->route('merchant.auth.login');
    }
}
