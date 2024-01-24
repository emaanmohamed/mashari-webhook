<?php

namespace App\Listeners;

use App\Models\Country;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class WebhookCallSucceededEventHandler
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookCallSucceededEvent $event): bool
    {
        $payload = $event->payload["country"];

        $country = Country::find($payload->id);
        $country->webhook_status = true;
        $country->save();
        return true;
    }
}
