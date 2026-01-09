<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Events\OrderStatusUpdated;
use App\Events\UserRegistered;
use App\Listeners\SendOrderNotification;
use App\Listeners\SendCustomerStatusUpdate;
use App\Listeners\SendWelcomeEmailToUser;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [
            SendOrderNotification::class,
        ],
        OrderStatusUpdated::class => [
            SendCustomerStatusUpdate::class,
        ],
        UserRegistered::class => [
            SendWelcomeEmailToUser::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}