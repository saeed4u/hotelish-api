<?php

namespace App\Providers;

use App\Repo\Auth\AuthRepoImpl;
use App\Repo\AuthRepo;
use App\Utils\Logging;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use Logging;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(
            function ($queries) {
                $sql = json_encode($queries->sql);
                $bindings = json_encode($queries->bindings);
                $time = json_encode($queries->time);
                $this->logQuery("SQL: $sql, Bindings: $bindings, Time: $time");
            }
        );
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
