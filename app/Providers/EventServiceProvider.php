<?php

namespace App\Providers;

use App\Events\CountryEvent;
use App\Listeners\CountryListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use App\Listeners\WebhookCallSucceededEventHandler;
use App\Listeners\FinalWebhookCallSucceededEventHandler;
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
        CountryEvent::class => [
            CountryListener::class,
        ],
        WebhookCallSucceededEvent::class => [
            WebhookCallSucceededEventHandler::class,
        ],
        FinalWebhookCallFailedEvent::class => [
            FinalWebhookCallSucceededEventHandler::class,
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
