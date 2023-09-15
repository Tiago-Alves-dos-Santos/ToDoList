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
            'login' => $prefix.'login',
            'logout' => $prefix.'logout',
            'verificationSend' => $prefix.'email/verification-notification',
            'two_factor_challenge' => $prefix.'two-factor-challenge',
            'confirm_password' => $prefix.'user/confirm-password',
            'confirmed_password-status' => $prefix.'user/confirmed-password-status',
            'confirmed_two_factor_authentication' => $prefix.'user/confirmed-two-factor-authentication',
            'password' => $prefix.'user/password',
            'profile_information' => $prefix.'user/profile-information',
            'two_factor_authentication' => $prefix.'user/two-factor-authentication',//POST - DELETE
            'two_factor_qr_code' => $prefix.'user/two-factor-qr-code',
            'two_factor_recovery_codes' => $prefix.'user/two-factor-recovery-codes',
            'two_factor_recovery_codes' => $prefix.'user/two-factor-recovery-codes',
            'two_factor_secret_key' => $prefix.'user/two-factor-secret-key',
        ];
    }
}
