<?php


namespace Modules\Order\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Order\Models\Order;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'items'=> OrderItemResource::collection($this->items),
            'customer'=>[
                'id'=>$this->customer_id,
                'display_name'=>$this->customer->display_name ?? ''
            ],
            'billing'=>$this->getJsonMeta('billing'),
            'shipping'=>$this->getJsonMeta('shipping'),
            'status'=>$this->status ?? Order::PENDING
        ];
    }
}