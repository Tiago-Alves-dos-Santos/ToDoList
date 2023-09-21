<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        Request::macro('isAdmin', function () {
            $url = request()->path(); //path
            //Verificar se a URL contém a palavra "admin"
            if (str_starts_with($url, 'admin')) {
                return true;
            } else {
                return false;
            }
        });
        Request::macro('myUser', function () {
            $guards = config('auth.guards');
            unset($guards['sanctum']);
            foreach ($guards as $guardName => $guardConfig) {
                $user = Auth::guard($guardName)->user();
                if (!empty($user)) {
                    return $user;
                }
            }
        });
        Request::macro('guard', function () {
            $guards = config('auth.guards');
            unset($guards['sanctum']);
            foreach ($guards as $guardName => $guardConfig) {
                $user = Auth::guard($guardName)->user();
                if (!empty($user)) {
                    return $guardName;
                }
            }
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
            return Limit::perMinutes(3, 1)->response(function () {
                return back()->withErrors(['error' => 'Limite de taxa excedido. Tente novamente mais tarde.']);
            });
        });
    }
}
