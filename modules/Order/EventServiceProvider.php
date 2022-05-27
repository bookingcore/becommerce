<?php


namespace Modules\Order;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Order\Events\OrderStatusUpdated;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Listeners\OrderStatusUpdatedNotification;
use Modules\Order\Listeners\PaymentUpdatedListener;
use Modules\Order\Listeners\ProductOnHoldListener;
use Modules\Order\Listeners\ProductStockListener;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        OrderStatusUpdated::class=>[
            ProductStockListener::class,
            OrderStatusUpdatedNotification::class,
        ],
    ];
}
