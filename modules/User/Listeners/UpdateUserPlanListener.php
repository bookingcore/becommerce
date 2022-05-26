<?php


namespace Modules\User\Listeners;


use Modules\Order\Events\OrderStatusUpdated;
use Modules\User\Models\Plan;

class UpdateUserPlanListener
{
    /**
     * Handle the event.
     *
     * @param $event OrderStatusUpdated
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
    {
        $order = $event->_order;
        switch ($order->status){
            case "completed":
                foreach ($order->items as $item){
                    switch ($item->object_model){
                        case "plan":
                            $plan = Plan::find($item->object_id);
                            if($plan) {
                                $user = $order->customer;
                                $user->applyPlan($plan,$item->price,$item->meta['annual'] ?? 0);
                            }
                            break;
                    }
                }
                break;
        }

    }
}
