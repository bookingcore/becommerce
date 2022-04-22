<?php


namespace Modules\User\Resources;


use App\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'order_date'=>$this->order_date,
            'total'=>$this->total,
            'status'=>$this->status,
            'items'=>$this->whenNeed('items',function(){
                return UserOrderItemResource::collection($this->items);
            })
        ];
    }

}
