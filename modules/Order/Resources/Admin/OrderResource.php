<?php


namespace Modules\Order\Resources\Admin;


use App\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Order\Models\Order;

class OrderResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'items'=> $this->whenNeed('items',OrderItemResource::collection($this->items)),
            'customer'=>[
                'id'=>$this->customer_id,
                'display_name'=>($this->customer) ? $this->customer->display_name .' ('.$this->customer_id.')' : ''
            ],
            'billing'=>$this->getJsonMeta('billing'),
            'shipping'=>$this->getJsonMeta('shipping'),
            'status'=>$this->status ?? Order::PENDING,
            'created_at'=>$this->created_at->format('Y-m-d H:i:s'),
            'email'=>$this->email,
            'phone'=>$this->phone
        ];
    }
}
