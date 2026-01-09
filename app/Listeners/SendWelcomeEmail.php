<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
{
    public function handle(OrderPlaced $event): void
    {
        // This listener is kept for backward compatibility
        // Welcome emails are now handled by UserRegistered event
        Log::info('OrderPlaced event received, welcome email handled by UserRegistered event');
    }
}