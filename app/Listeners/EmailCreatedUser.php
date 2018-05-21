<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\UserCreated;
use App\Events\UserCreatedEvent;
use Illuminate\Support\Facades\Mail;

class EmailCreatedUser
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        Mail::to($event->user->email)->send(new UserCreated);
    }
}
