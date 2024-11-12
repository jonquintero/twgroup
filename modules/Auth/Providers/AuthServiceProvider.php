<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
       {
           $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
          // $this->mergeConfigFrom(__DIR__.'/../config.php', 'clientCategory');
          $this->loadViewsFrom(__DIR__.'/../resources/views', 'auth');
           $this->app->register(RouteServiceProvider::class);
       }
}
