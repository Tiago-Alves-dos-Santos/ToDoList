<?php

namespace App\Services;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Admin\CreateNewAdmin;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Admin\ResetAdminPassword;
use App\Actions\Admin\UpdateAdminPassword;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Admin\UpdateAdminProfileInformation;
use App\Actions\Fortify\UpdateUserProfileInformation;
/** USE A FACADE: FortifyFacade */
final class FortifyCustom
{
    public function loginView(): Response
    {
        return Inertia::render('Home');
    }
    public function registerView(): Response
    {
        if (request()->isAdmin()) {
            //admin não pode ser cadastrado publicamente - regra do sistema
            return redirect()->route('login');
        } else {
            return Inertia::render('Home');
        }
    }
    public function verifyEmailView(): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $email_time_expiration = config('auth.verification.expire');
        return Inertia::render('Auth/VerifyEmail', [
            'verified_email' => $user->hasVerifiedEmail(),
            'email_time_expiration' => $email_time_expiration,
        ]);
    }
    public function forgotPasswordView(): Response
    {
        return Inertia::render('Auth/ForgotPassword');
    }
    public function resetPasswordView(Request $request): Response
    {
        $token = $request->token;
        $email = $request->email;
        return Inertia::render('Auth/ResetPassword', compact(
            'token',
            'email'
        ));
    }
    public function confirmPasswordView(Request $request): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }
    public function twoFactorChallengeView(Request $request): Response
    {
        return Inertia::render('Auth/TwoFactorChallenge');
    }

    public function customLogin($request, $model)
    {
        $user = $model::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }
    }
    /**
     * Retorna classe de ações com base se é user ou admin
     *
     * @param boolean $admin - Informe se o usuario é admin
     * @return array
     */
    public function getActionsAdminOrUser(bool $admin): array
    {
        return [
            'createUser' => $admin ?  CreateNewAdmin::class : CreateNewUser::class,
            'updatePassword' => $admin ?  UpdateAdminPassword::class : UpdateUserPassword::class,
            'updateProfileInformation' => $admin ? UpdateAdminProfileInformation::class : UpdateUserProfileInformation::class,
            'resetPassword' => $admin ? ResetAdminPassword::class : ResetUserPassword::class,
        ];
    }
}
