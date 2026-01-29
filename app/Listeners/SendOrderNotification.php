<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
{
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order->load('orderItems.menuItem');
        Mail::to('easystep25@gmail.com')->send(new OrderNotification($order));
    }
}