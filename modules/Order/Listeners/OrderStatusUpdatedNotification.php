<?php


namespace Modules\Order\Listeners;


use Modules\Order\Events\OrderStatusUpdated;
use Modules\Order\Models\Order;

class OrderStatusUpdatedNotification
{

    /**
     *
     * @param OrderStatusUpdated $event
     * @return mixed
     */
    public function handle(OrderStatusUpdated $event)
    {
        $order = $event->_order;

        if(in_array($event->_old_status,[Order::PENDING,Order::FAILED,Order::CANCELLED]) and in_array($order->status,[Order::COMPLETED,Order::PROCESSING,Order::ON_HOLD])){
            return $order->sendNewOrderNotifications();
        }

        if(in_array($event->_old_status,[Order::ON_HOLD,Order::PENDING]) and in_array($order->status,[Order::CANCELLED])){
            return $order->sendCancelledOrderEmails();
        }
    }
}
