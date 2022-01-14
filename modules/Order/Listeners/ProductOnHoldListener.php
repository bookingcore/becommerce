<?php


namespace Modules\Order\Listeners;


use Illuminate\Support\Carbon;
use Modules\Order\Events\OrderUpdated;
use Modules\Order\Models\Order;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductOnHold;

class ProductOnHoldListener
{
    public function handle(OrderUpdated $event)
    {
        $order = $event->_order;
        switch ($order->status) {
            case Order::ON_HOLD:
//              add product on-hold in order item
            $items = $order->items;
                if(!empty($items)){
                    $setting_expired_at = setting_item('product_on_hold_expired_at',1);
                    $expired_at  = Carbon::now()->addDays($setting_expired_at)->format('Y-m-d H:i:s');
                    foreach ($items as $item) {
                       $model = $item->model();
                       if(!empty($model) and $model instanceof  Product){
                           $productOnHold = new ProductOnHold();
                           $productOnHold->order_id = $item->order_id;
                           $productOnHold->product_id = $item->object_id;
                           $productOnHold->variant_id = $item->variant_id;
                           $productOnHold->qty = $item->qty;
                           $productOnHold->expired_at = $expired_at;
                           $productOnHold->save();
                       }
                    }
                }
                break;
            case Order::COMPLETED:
//              remove product on-hold in order item
                ProductOnHold::where('order_id',$order->id)->delete();

                break;
        }
    }
}
