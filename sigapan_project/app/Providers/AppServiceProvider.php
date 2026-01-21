<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // ==============================
        // GLOBAL PREFS (ANTI KOSONG)
        // ==============================
        $prefs = Cache::get('prefs_composer');

        // Kalau cache rusak / kosong
        if (!is_array($prefs)) {
            $prefs = [];
        }

        // Paksa semua key penting selalu ada
        $prefs['title']   = $prefs['title']   ?? 'SIM PJU Bantul';
        $prefs['logo']    = $prefs['logo']    ?? 'assets/images/logo.png';
        $prefs['favicon'] = $prefs['favicon'] ?? 'assets/images/favicon.ico';

        // Simpan ulang supaya tidak {} lagi
        Cache::put('prefs_composer', $prefs, 60 * 60);

        // Share ke semua view
        View::share('prefs_composer', $prefs);
        View::share('title', $prefs['title']);

        // ==============================
        // FORCE HTTPS
        // ==============================
        if (config('custom.force_https')) {
            $this->app['request']->server->set('HTTPS', 'on');
            URL::forceScheme('https');
        }

        // ==============================
        // VERIFICATION EMAIL
        // ==============================
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new \App\Mail\VerificationMail($notifiable, $url))
                ->to($notifiable->email)
                ->subject('[No Reply] Verifikasi Akun');
        });

        // ==============================
        // RESET PASSWORD
        // ==============================
        ResetPassword::toMailUsing(function ($notifiable, string $token) {
            return (new \App\Mail\ForgetPassword(
                $notifiable,
                url(route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->email,
                ], false))
            ))
                ->to($notifiable->email)
                ->subject('[No Reply] Lupa Password');
        });
    }
}