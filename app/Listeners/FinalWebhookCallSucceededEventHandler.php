<?php

namespace App\Listeners;

use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FinalWebhookCallSucceededEventHandler
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
    public function handle(FinalWebhookCallFailedEvent $event): void
    {
        logger(json_encode($event));
    }
}
