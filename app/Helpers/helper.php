<?php
if (!function_exists('routesFortify')) {
    /**
     * Retorna um array com as rotas do fortify, para saber o tipo use 'route:list'
     *
     * @return array
     */
    function routesFortify(): array
    {
        return [
            'register' => route('register'),//POST
            'reset_password' => route('password.update'),//POST
            'forgot_password_get' => route('password.request'),
            'forgot_password' => route('password.email'),
            'login' => route('login'), //POST
            'logout' => route('logout'), //POST
            'verificationSend' => route('verification.send'),//,
            'confirm_password' => route('password.confirm'),
            'confirmed_password_status' => route('password.confirmation'), //GET
            'confirmed_two_factor_authentication' => route('two-factor.confirm'), //POST
            'password' => route('user-password.update'),
            'profile_information' => route('user-profile-information.update'),
            'two_factor_confirm' => route('two-factor.confirm'),//POST
            'two_factor_challenge' => route('two-factor.login'),//POST - DELETE
            'two_factor_authentication' => route('two-factor.enable'),//POST
            'two_factor_authentication_disable' => route('two-factor.disable'),// DELETE
            'two_factor_qr_code' => route('two-factor.qr-code'), //GET
            'two_factor_recovery_codes' => route('two-factor.recovery-codes'), //POST - GET
            'two_factor_secret_key' => route('two-factor.secret-key'),
        ];
    }
}


