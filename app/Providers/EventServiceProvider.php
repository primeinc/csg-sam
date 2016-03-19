<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*
         * Frontend Events
         */

        /*
         * Authentication Events
         */
        \App\Events\Frontend\Auth\UserLoggedIn::class  => [
            \App\Listeners\Frontend\Auth\UserLoggedInListener::class,
        ],
        \App\Events\Frontend\Auth\UserLoggedOut::class => [
            \App\Listeners\Frontend\Auth\UserLoggedOutListener::class,
        ],
        \App\Events\Frontend\Auth\UserRegistered::class => [
            \App\Listeners\Frontend\Auth\UserRegisteredListener::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'App\Models\Access\SocialiteProviders\Google\GoogleExtendSocialite@handle',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen('audit.asset.create', 'App\Classes\AuditLogHandler@onAssetCreate');
        $events->listen('audit.asset.edit', 'App\Classes\AuditLogHandler@onAssetEdit');
        $events->listen('audit.asset.checkout', 'App\Classes\AuditLogHandler@onAssetCheckout');
        $events->listen('audit.asset.checkin', 'App\Classes\AuditLogHandler@onAssetCheckin');
        $events->listen('audit.asset.location.change', 'App\Classes\AuditLogHandler@onAssetLocationChange');
        $events->listen('audit.asset.checkout.reminder', 'App\Classes\AuditLogHandler@onAssetCheckoutReminder');
        $events->listen('audit.asset.checkout.edit', 'App\Classes\AuditLogHandler@onCheckoutEdit');
    }
}
