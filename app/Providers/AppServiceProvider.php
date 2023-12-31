<?php

namespace App\Providers;

use App\Services\PageFront;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;

use App\Models\Sanctum\PersonalAccessToken;
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
        //setando rateLimit na verficação de email
        $this->app->afterResolving(EmailVerificationNotificationController::class, function ($controller) {
            $controller->middleware('throttle:verification');
        });
        //************MACRO REQUEST*************/
        Request::macro('isAdmin', function () {
            $url = request()->path();
            //Verificar se a URL começa a palavra "admin"
            if (str_starts_with($url, 'admin')) {
                return true;
            } else {
                return false;
            }
        });
        //retorna o guard atual
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
        Arr::macro('allValuesToBoolean', function ($array) {
            foreach ($array as $key => $value) {
                $array[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }
            return $array;
        });
        //FACADE
        $this->app->bind('PageFront', fn() => new PageFront(request()->guard()));
        $this->app->bind('AuthService', fn() => new AuthService(request()->guard()));
        //RATE LIMITE
        RateLimiter::for('verification', function (Request $request) {
            return Limit::perMinutes(3, 1)->response(function () {
                return back()->withErrors(['error' => 'Limite de taxa excedido. Tente novamente mais tarde.']);
            });
        });
        //SANCTUM
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
