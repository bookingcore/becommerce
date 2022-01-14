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
        $items = $order->items;
        switch ($order->status) {
            case Order::ON_HOLD:
//              add product on-hold in order item
                $this->reductionStock($items);
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
            case Order::PROCESSING:
                $this->reductionStock($items);
                break;
            case Order::COMPLETED:
                $this->reductionStock($items);
//              remove product on-hold in order item
                ProductOnHold::where('order_id',$order->id)->delete();
                break;
            case Order::CANCELLED:
            case Order::PENDING:
            case Order::FAILED:
                $this->returnStock($items);
                break;
        }
    }

    public function reductionStock($items){
        if(!empty($items)){
            foreach ($items as $item) {
                if(empty($item->reduced_stock)){
                    $model = $item->model();
                    if(!empty($model) and $model instanceof  Product){
                        if($model->is_manage_stock){
                            $model->quantity -= $item->qty;
                            if($model->quantity <=0){
                                $model->quantity = 0 ;
                                $model->stock_status ='out';
                            }
                            $model->save();
                        }
                    }
                    $item->reduced_stock = $item->qty;
                    $item->save();
                }
            }
        }
    }
    public function returnStock($items){
        if(!empty($items)){
            foreach ($items as $item) {
                if(empty($item->reduced_stock)){
                    $model = $item->model();
                    if(!empty($model) and $model instanceof  Product){
                        if($model->is_manage_stock){
                            $model->quantity += $item->reduced_stock;
                            if($model->quantity<=0){
                                $model->stock_status ='out';
                            }
                            $model->save();
                        }
                    }
                    $item->reduced_stock = null;
                    $item->save();
                }
            }
        }
    }
}
