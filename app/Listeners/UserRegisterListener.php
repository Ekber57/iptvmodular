<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;

class UserRegisterListener
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
    public function handle(UserRegisterEvent $event): void
    {
        // ddd($event->user);
    }
}
