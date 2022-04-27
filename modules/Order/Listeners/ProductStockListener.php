<?php


namespace Modules\Order\Listeners;



use Modules\Order\Events\OrderUpdated;
use Modules\Order\Models\Order;
use Modules\Product\Models\Product;

class ProductStockListener
{
    public function handle(OrderUpdated $event)
    {
        $order = $event->_order;
        $items = $event->_items;
        switch ($order->status) {
            case Order::PROCESSING:
            case Order::ON_HOLD:
                $this->reduceStock($items);
                break;
            case Order::CANCELLED:
            case Order::PENDING:
            case Order::FAILED:
                $this->returnStock($items);
                break;
        }
    }

    public function reduceStock($items){
        if(!empty($items)){
            foreach ($items as $item) {
                if(empty($item->reduced_stock)){
                    $model = $item->model();
                    if(!empty($model) and $model instanceof  Product){
                        if($model->check_manage_stock()){
                            if(!empty($item->variation_id)){
                                $variation = $model->variations()->where('id',$item->variation_id)->first();
                                if(!empty($variation)){
                                    $variation->quantity -= $item->qty;
                                    $variation->sale_count += $item->qty;
                                    if($variation->quantity <=0){
                                        $variation->quantity = 0 ;
                                        $variation->stock_status ='out';
                                    }
                                    $variation->save();
                                }
                            }
                            $model->quantity -= $item->qty;
                            $model->sale_count += $item->qty;
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
                if(!empty($item->reduced_stock)){
                    $model = $item->model();
                    if(!empty($model) and $model instanceof  Product){
                        if($model->check_manage_stock()){
                            if(!empty($item->variation_id)){
                                $variation = $model->variations()->where('id',$item->variation_id)->first();
                                if(!empty($variation)){
                                    $variation->quantity += $item->reduced_stock;
                                    $variation->sale_count -= $item->qty;
                                    $variation->sale_count = max(0,$variation->sale_count);
                                    if($variation->quantity<=0){
                                        $variation->stock_status ='out';
                                    }
                                    $variation->save();
                                }
                                $model->quantity += $item->reduced_stock;
                                $model->sale_count -= $item->qty;
                                $model->sale_count = max(0,$model->sale_count);
                                if($model->quantity<=0){
                                    $model->stock_status ='out';
                                }
                                $model->save();
                            }

                        }
                    }
                    $item->reduced_stock = null;
                    $item->save();
                }
            }
        }
    }
}
