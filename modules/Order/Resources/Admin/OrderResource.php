<?php


namespace Modules\Order\Resources\Admin;


use App\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Order\Models\Order;
use Modules\User\Resources\UserResource;

class OrderResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'items'=> $this->whenNeed('items',function(){
                return OrderItemResource::collection($this->items);
            }),
            'customer'=> new UserResource($this->customer,['address']),
            'billing'=>$this->getJsonMeta('billing'),
            'shipping'=>$this->getJsonMeta('shipping'),
            'status'=>$this->status ?? Order::PENDING,
            'created_at'=>$this->created_at->format('Y-m-d H:i:s'),
            'email'=>$this->email,
            'phone'=>$this->phone
        ];
    }
}
