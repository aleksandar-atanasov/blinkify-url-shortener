<?php

namespace Modules\ShortLink\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\ShortLink\Contracts\CounterRepositoryInterface;
use Modules\ShortLink\Contracts\ShortLinkRepositoryInterface;
use Modules\ShortLink\Repositories\CounterRepository;
use Modules\ShortLink\Repositories\ShortLinkRepository;

class ShortLinkServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected array $repositories = [
        ShortLinkRepositoryInterface::class => ShortLinkRepository::class,
        CounterRepositoryInterface::class => CounterRepository::class
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'shortLink');
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, function () use ($repository) {
                return new $repository;
            });
        }
    }
}
