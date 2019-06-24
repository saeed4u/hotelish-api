<?php

namespace App\Providers;

use App\Repo\Auth\AuthRepoImpl;
use App\Repo\AuthRepo;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthRepo::class, AuthRepoImpl::class);
    }
}
