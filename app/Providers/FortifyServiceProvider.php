<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Facades\FortifyViewFacade;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;

use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $url = request()->path();
        // Verificar se a URL contém a palavra "admin"
        if (str_starts_with($url, 'admin')) {
            config(['fortify.guard' => 'admin']);
            config(['fortify.prefix' => 'admin']);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            if(request()->isAdmin()) {
                return FortifyViewFacade::customloginView($request, app(Admin::class));
            }else{
                return FortifyViewFacade::customloginView($request, app(User::class));
            }
        });

        Fortify::loginView(function (Request $request) {
            return FortifyViewFacade::loginView();
        });
        Fortify::registerView(function (Request $request) {
            return FortifyViewFacade::registerView();
        });
        Fortify::verifyEmailView(function (Request $request) {
            return FortifyViewFacade::verifyEmailView();
        });
        Fortify::requestPasswordResetLinkView(function (Request $request) {
            return FortifyViewFacade::forgotPasswordView();
        });
        Fortify::resetPasswordView(function (Request $request) {
            return FortifyViewFacade::resetPasswordView($request);
        });
        Fortify::confirmPasswordView(function (Request $request) {
            return FortifyViewFacade::confirmPasswordView($request);
        });
        Fortify::twoFactorChallengeView(function (Request $request) {
            return FortifyViewFacade::twoFactorChallengeView($request);
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
