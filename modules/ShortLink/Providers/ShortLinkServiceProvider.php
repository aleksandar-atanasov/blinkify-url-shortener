<?php

namespace Modules\ShortLink\Providers;

use Illuminate\Support\ServiceProvider;

class ShortLinkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'shortLink');
        $this->app->register(RouteServiceProvider::class);
    }
}
