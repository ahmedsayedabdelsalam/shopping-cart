<?php

namespace App\Listeners;

use App\Events\OrderPurchasedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class EmailPurchasedUser
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
     * @param  OrderPurchasedEvent  $event
     * @return void
     */
    public function handle(OrderPurchasedEvent $event)
    {
        Mail::to($event->order->user->email)->send(new OrderShipped($event->order));
    }
}
