<?php

namespace App\Listeners;

use App\Mail\OrderCreateMail;
use App\Events\OrderCreateEvent;
use App\Models\Orders;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreateSendEmailtoAdminListeners
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {
        // dd($orders);
        // $this->order = $order;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreateEvent $event): void
    {
        // dd($event->orders);
        // Mail::to(auth()->user()->email)->send(new OrderCreateMail($event->orders));
        Mail::to(env('ADMIN_MAIL_GROUP'))->send(new OrderCreateMail($event->orders));
    }
}
