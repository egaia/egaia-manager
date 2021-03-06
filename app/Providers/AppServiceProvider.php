<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('fr');
        setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set('Europe/Paris');
        User::observe(UserObserver::class);
    }
}
