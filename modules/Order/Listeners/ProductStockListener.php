<?php


namespace Modules\Order\Listeners;



use Modules\Order\Events\OrderUpdated;
use Modules\Order\Models\Order;
use Modules\Product\Models\BaseProduct;
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
                $this->reductionStock($items);
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
                    if(!empty($model) and $model instanceof  BaseProduct){
                        if($model->is_manage_stock()){
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
                        if($model->is_manage_stock()){
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
