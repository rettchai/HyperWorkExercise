<?php

namespace App\Providers;

use App\Events\OrderCreateEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Google\GoogleExtendSocialite;
use App\Listeners\OrderCreateSendEmailtoAdminListeners;
use SocialiteProviders\Facebook\FacebookExtendSocialite;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use SocialiteProviders\LaravelPassport\LaravelPassportExtendSocialite;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class => [
            LaravelPassportExtendSocialite::class.'@handle',
            GoogleExtendSocialite::class.'@handle',
            FacebookExtendSocialite::class.'@handle',
        ],
        OrderCreateEvent::class => [
            OrderCreateSendEmailtoAdminListeners::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
