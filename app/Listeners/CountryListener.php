<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\WebhookServer\WebhookCall;

class CountryListener
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
    public function handle(object $event): void
    {
        logger($event->data);
        $x = WebhookCall::create()
            ->url($event->callback)
            ->useSecret(env('WEBHOOK_SECRET_KEY'))
            ->payload([
                'action' => $event->type,
                'oldData' => $event->oldData, // 'oldData' => 'oldData
                'updatedData' => $event->data,
            ])
            ->dispatch();
        dd($x);

    }
}
