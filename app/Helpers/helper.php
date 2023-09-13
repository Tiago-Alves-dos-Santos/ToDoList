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
            'login' => $prefix.'login',
            'logout' => $prefix.'logout',
            'verificationSend' => $prefix.'email/verification-notification',
            'two-factor-challenge' => $prefix.'two-factor-challenge',
            'confirm-password' => $prefix.'user/confirm-password',
            'confirmed-password-status' => $prefix.'user/confirmed-password-status',
            'confirmed-two-factor-authentication' => $prefix.'user/confirmed-two-factor-authentication',
            'password' => $prefix.'user/password',
            'profile-information' => $prefix.'user/profile-information',
            'two-factor-authentication' => $prefix.'user/two-factor-authentication',//POST - DELETE
            'two-factor-qr-code' => $prefix.'user/two-factor-qr-code',
            'two-factor-recovery-codes' => $prefix.'user/two-factor-recovery-codes',
            'two-factor-recovery-codes' => $prefix.'user/two-factor-recovery-codes',
            'two-factor-secret-key' => $prefix.'user/two-factor-secret-key',
        ];
    }
}
