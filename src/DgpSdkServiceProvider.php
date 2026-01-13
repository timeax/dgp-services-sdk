<?php
declare(strict_types=1);

namespace Dgp\Sdk;

use Illuminate\Support\ServiceProvider;
use Dgp\Sdk\Driver\DriverRegistry;
use Dgp\Sdk\Driver\DriverResolver;
use Dgp\Sdk\Driver\DriverManager;

final class DgpSdkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DriverRegistry::class, fn () => new DriverRegistry());

        $this->app->singleton(DriverResolver::class, fn ($app) =>
        new DriverResolver($app->make(DriverRegistry::class))
        );

        $this->app->singleton(DriverManager::class, fn ($app) =>
        new DriverManager($app->make(DriverResolver::class))
        );
    }
}