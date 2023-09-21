<?php
if (!function_exists('prefixAuth')) {
    function prefixAuth(): string
    {
        $prefix = config('fortify.prefix');
        return empty($prefix) ? '/' : $prefix.'/';
    }
}
if (!function_exists('routesFortify')) {
    function routesFortify(): array
    {
        $prefix = prefixAuth();
        return [
            'register' => $prefix.'register',
            'reset_password' => $prefix.'reset-password',
            'forgot_password' => $prefix.'forgot-password',
            'login' => route('login'), //route('login')
            'logout' => $prefix.'logout',
            'verificationSend' => route('verification.send'),//$prefix.'email/verification-notification',
            'confirm_password' => route('password.confirm'),
            'confirmed_password_status' => $prefix.'user/confirmed-password-status',
            'confirmed_two_factor_authentication' => $prefix.'user/confirmed-two-factor-authentication',
            'password' => route('user-password.update'),
            'profile_information' => $prefix.'user/profile-information',
            'two_factor_challenge' => route('two-factor.login'),//POST - DELETE
            'two_factor_authentication' => $prefix.'user/two-factor-authentication',//POST - DELETE
            'two_factor_qr_code' => $prefix.'user/two-factor-qr-code',
            'two_factor_recovery_codes' => $prefix.'user/two-factor-recovery-codes',
            'two_factor_recovery_codes' => $prefix.'user/two-factor-recovery-codes',
            'two_factor_secret_key' => $prefix.'user/two-factor-secret-key',
        ];
    }
}


