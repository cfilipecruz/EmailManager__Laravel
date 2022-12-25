<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Para quem lê os emails
        \Gate::define('viewEmails', function ($user) {
            if ($user->nivelpermissao_id <= 2) {
                return true;
            }
            return false;
        });

        //Para administradores
        \Gate::define('admin', function ($user) {
            if ($user->nivelpermissao_id <= 1) {
                return true;
            }
            return false;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
