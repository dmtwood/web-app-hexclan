<?php

namespace App\Listeners;

use App\Notifications\PINCodeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPINCodeNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        // Send PIN code only to unprivileged users.

        if (!$event->user->is_active) {
            $event->user->notify(new PINCodeNotification());
        }
    }
}
