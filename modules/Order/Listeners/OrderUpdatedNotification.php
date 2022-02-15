<?php


namespace Modules\Order\Listeners;


use Illuminate\Support\Facades\Mail;
use Modules\Order\Emails\OrderEmail;
use Modules\Order\Events\OrderUpdated;
use Modules\Order\Models\Order;

class OrderUpdatedNotification
{

    public function handle(OrderUpdated $event)
    {
        $order = $event->_order;
        switch ($order->status) {
            case Order::PROCESSING:
            case Order::COMPLETED:
                $order->sendNewOrderEmails();
            break;
        }
    }
}
