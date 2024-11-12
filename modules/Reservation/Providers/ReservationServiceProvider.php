<?php

namespace Modules\Reservation\Providers;

use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
          // $this->mergeConfigFrom(__DIR__.'/../config.php', 'clientCategory');
          $this->loadViewsFrom(__DIR__.'/../resources/views', 'reservation');
           $this->app->register(RouteServiceProvider::class);
       }
}
