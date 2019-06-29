<?php

namespace App\Providers;

use App\Repo\Auth\AuthRepoImpl;
use App\Repo\AuthRepo;
use App\Repo\BookingRepo;
use App\Repo\BookingRepoImpl;
use App\Repo\Hotel\CrudRepoImpl;
use App\Repo\Hotel\HotelRepo;
use App\Repo\PricingRepo;
use App\Service\AuthService;
use App\Service\BookingService;
use App\Service\HotelService;
use App\Service\PricingService;
use App\Service\RoomService;
use App\Service\RoomTypeService;
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
        $this->app->singleton('crud_repo', CrudRepoImpl::class);
        $this->app->singleton('pricing_repo', PricingRepo::class);
        $this->app->singleton(BookingRepo::class, BookingRepoImpl::class);

        $this->app->singleton(AuthService::class, function () {
            return new AuthService($this->app->make(AuthRepo::class));
        });

        $this->app->singleton(HotelService::class, function () {
            return new HotelService($this->app->make('crud_repo'));
        });

        $this->app->singleton(RoomService::class, function () {
            return new RoomService($this->app->make('crud_repo'));
        });

        $this->app->singleton(RoomTypeService::class, function () {
            return new RoomTypeService($this->app->make('crud_repo'));
        });

        $this->app->singleton(PricingService::class, function () {
            return new PricingService($this->app->make('pricing_repo'));
        });

        $this->app->singleton(BookingService::class, function () {
            return new BookingService($this->app->make(BookingRepo::class));
        });

    }
}
