<?php

declare(strict_types=1);

namespace Hubmais\HCheckoutOnboarding\Providers;

use Illuminate\Support\ServiceProvider;

class HCheckoutOnboardingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(\Hubmais\HClient\Providers\HClientServiceProvider::class);

       /** @noinspection PhpUndefinedMethodInspection */
        $this->app->singleton(\Hubmais\HCheckoutOnboarding\Services\Manager::class, function ($app) {
            return new \Hubmais\HCheckoutOnboarding\Services\Manager($app->make(\Hubmais\HClient\Client::class));
        });

        $this->app->singleton('h-smart-tef', function ($app) {
            return $app->make(\Hubmais\HCheckoutOnboarding\Services\Manager::class);
        });
    }

    public function boot(): void
    {
        $this->publishes(self::pathsToPublish(\Hubmais\HClient\Providers\HClientServiceProvider::class), 'h-checkount-onboarding-config');
    }
}