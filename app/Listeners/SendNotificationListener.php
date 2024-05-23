<?php

namespace App\Listeners;

use App\Events\ManualPaymentRequestEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationListener
{
    /**
     * Create the event listener.
     */
    // public $objec
    public function __construct($object)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ManualPaymentRequestEvent $event): void
    {
        //
    }
}
