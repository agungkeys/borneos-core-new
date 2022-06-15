<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
          if($request->is('api/*')) {
              return route('authentication-failed');
          }
          else if ($request->is('admin/*') || $request->is('admin'))
          {
              return route('admin.auth.login');
          }
          else if ($request->is('merchant/*') || $request->is('merchant'))
          {
              return route('merchant.auth.login');
          }
          else if ($request->is('courier/*') || $request->is('courier'))
          {
              return route('courier.auth.login');
          }
          else
          {
              return route('/');
          }
    }
}
