<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Confirmar Email') //titulo
                ->view('email.verify_email', [
                    'url' => $url,
                    'user' => $notifiable
                ]);
        });
        // ResetPassword::toMailUsing(function (object $notifiable, string $url) {
        //     return (new MailMessage)
        //         ->subject('Confirmar Email') //titulo
        //         ->view('email.verify_email', [
        //             'url' => $url,
        //             'user' => $notifiable
        //         ]);
        // });

    }


}
