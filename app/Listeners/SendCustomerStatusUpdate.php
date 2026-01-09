<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Mail\OrderStatusUpdate;
use Illuminate\Support\Facades\Mail;

class SendCustomerStatusUpdate
{
    public function handle(OrderStatusUpdated $event): void
    {
        Mail::to($event->order->customer_email)->send(new OrderStatusUpdate($event->order));
    }
}