<?php

namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving(EmailVerificationNotificationController::class, function ($controller) {
            $controller->middleware('throttle:verification');
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Inertia::share('routes_fortify', routesFortify());
        RateLimiter::for('verification', function (Request $request) {
            return Limit::perMinutes(3,1)->response(function(){
                return back()->withErrors(['error' => 'Limite de taxa excedido. Tente novamente mais tarde.']);
            });
        });
    }
}
