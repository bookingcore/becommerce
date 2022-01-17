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
            case Order::COMPLETED:
                // Send Email
                Mail::to($order->customer)->queue(new OrderEmail($order));
                if(setting_item('admin_email')) {
                    Mail::to(setting_item('admin_email'))->queue(new OrderEmail($order, 'admin'));
                }

            break;
        }
    }
}
