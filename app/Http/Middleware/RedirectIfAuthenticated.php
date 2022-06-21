<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next, ...$guards)
    public function handle(Request $request, Closure $next, ...$guards)
    {
      foreach ($guards as $guard) {

        // if ($guard == 'vendor' && Auth::guard($guard)->check()) {
        //     return redirect()->route('vendor.dashboard');
        // }
        //
        // if ($guard == 'admin' && Auth::guard($guard)->check()) {
        //   return redirect()->route('admin.dashboard');
        // }
        //
        // if ($guard == 'curier' && Auth::guard($guard)->check()) {
        //   return redirect()->route('admin.curier');
        // }

        switch ($guard) {
          case 'merchant':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('merchant.dashboard');
            }
            break;
          case 'admin':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('admin.dashboard');
            }
            break;
          default:
            if (Auth::guard($guard)->check()) {
              // return response()->json([],404);
              return redirect(RouteServiceProvider::HOME);
            }
            break;
        }
      }
      return $next($request);
    }
}
