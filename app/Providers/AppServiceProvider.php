<?php

namespace App\Providers;

use App\Repositories\SocialUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Laravel\Passport\Bridge\UserRepository::class,
            SocialUserRepository::class
        );

    }
}
