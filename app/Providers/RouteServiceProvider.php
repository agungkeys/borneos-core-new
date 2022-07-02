<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */


    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/landing';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
      $this->configureRateLimiting();
      $this->routes(function () {
        Route::prefix('api')
          ->middleware('api')
          ->namespace($this->namespace)
          ->group(base_path('routes/api.php'));
        Route::middleware('web')
          ->namespace($this->namespace)
          ->group(base_path('routes/web.php'));
        Route::prefix('admin')
          ->middleware('web')
          ->namespace($this->namespace)
          ->group(base_path('routes/admin.php'));
        Route::prefix('merchant')
          ->middleware('web')
          ->namespace($this->namespace)
          ->group(base_path('routes/merchant.php'));
        Route::prefix('courier')
          ->middleware('web')
          ->namespace($this->namespace)
          ->group(base_path('routes/courier.php'));
        Route::prefix('api/v1')
          ->middleware('api')
          ->namespace($this->namespace)
          ->group(base_path('routes/api/v1/api.php'));
      });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
