<?php

namespace Modules\Room\Providers;

use Illuminate\Support\ServiceProvider;

class RoomServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
          // $this->mergeConfigFrom(__DIR__.'/../config.php', 'clientCategory');
          $this->loadViewsFrom(__DIR__.'/../resources/views', 'room');
           $this->app->register(RouteServiceProvider::class);
       }
}
