<?php

namespace App\Providers;

use App\Mail\authAccount;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
        //     return (new MailMessage)
        //         ->subject('Overenie e-mailovej adresy')
        //         ->view('mail.verify_email', ['url' => $url]);
        // });

        // $user->notify((new VerifyEmail())->onQueue('emails'));

        ResetPassword::toMailUsing(function (object $notifiable, string $url) {
            $resetUrl = url(route('password.reset', ['token' => $url, 'email' => $notifiable->email], false));
            return (new MailMessage)
                ->subject('Obnovenie hesla')
                ->view('mail.reset_password', ['url' => $resetUrl, 'email' => $notifiable->email]);
        });
    }
}
