<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Facades\FortifyFacade;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Verificar se a URL contém a palavra "admin"
        if (request()->isAdmin()) {
            config(['fortify.guard' => 'admin']);
            config(['fortify.prefix' => 'admin']);
            config(['fortify.passwords' => 'admins']);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $actions = FortifyFacade::getActionsForAdmin(request()->isAdmin());
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing($actions['updateProfileInformation']);
        Fortify::updateUserPasswordsUsing($actions['updatePassword']);
        Fortify::resetUserPasswordsUsing($actions['resetPassword']);

        Fortify::authenticateUsing(function (Request $request) {
            $model = request()->isAdmin() ? app(Admin::class) : app(User::class);
            return FortifyFacade::customLogin($request, $model);
        });

        Fortify::loginView(function (Request $request) {
            return FortifyFacade::loginView();
        });
        Fortify::registerView(function (Request $request) {
            return FortifyFacade::registerView();
        });
        Fortify::verifyEmailView(function (Request $request) {
            return FortifyFacade::verifyEmailView();
        });
        Fortify::requestPasswordResetLinkView(function (Request $request) {
            return FortifyFacade::forgotPasswordView();
        });
        Fortify::resetPasswordView(function (Request $request) {
            return FortifyFacade::resetPasswordView($request);
        });
        Fortify::confirmPasswordView(function (Request $request) {
            return FortifyFacade::confirmPasswordView($request);
        });
        Fortify::twoFactorChallengeView(function (Request $request) {
            return FortifyFacade::twoFactorChallengeView($request);
        });
        /***RATE LIMITERS***/
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
