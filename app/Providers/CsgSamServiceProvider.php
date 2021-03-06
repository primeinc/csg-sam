<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider.
 */
class CsgSamServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Register service provider bindings.
     */
    public function registerBindings()
    {
        $this->app->bind(
            \App\Repositories\Frontend\Asset\AssetContract::class,
            \App\Repositories\Frontend\Asset\EloquentAssetRepository::class
        );
        $this->app->bind(
            \App\Repositories\Frontend\Dealership\DealershipContract::class,
            \App\Repositories\Frontend\Dealership\EloquentDealershipRepository::class
        );
        $this->app->bind(
            \App\Repositories\Frontend\Dealer\DealerContract::class,
            \App\Repositories\Frontend\Dealer\EloquentDealerRepository::class
        );
        $this->app->bind(
            \App\Repositories\Frontend\Mfr\MfrContract::class,
            \App\Repositories\Frontend\Mfr\EloquentMfrRepository::class
        );
        $this->app->bind(
            \App\Repositories\Frontend\Checkout\CheckoutContract::class,
            \App\Repositories\Frontend\Checkout\EloquentCheckoutRepository::class
        );
        $this->app->bind(
            \App\Repositories\Frontend\Location\LocationContract::class,
            \App\Repositories\Frontend\Location\EloquentLocationRepository::class
        );
        $this->app->bind(
            \App\Repositories\Frontend\AssetLogs\AssetLogsContract::class,
            \App\Repositories\Frontend\AssetLogs\EloquentAssetLogsRepository::class
        );
    }
}
