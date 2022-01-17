<?php


namespace Modules\Order\Events;


use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Order\Models\Order;

class OrderUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * @var \LaravelIdea\Helper\Modules\Order\Models\_IH_OrderItem_C|mixed|\Modules\Order\Models\OrderItem[]
     */
    public $_items;
    /**
     * @var Order
     */
    public $_order;

    public function __construct(Order $order){
        $this->_order = $order;
        $this->_items = $order->items;
    }
}
