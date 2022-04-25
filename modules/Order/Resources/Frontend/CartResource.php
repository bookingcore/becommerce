<?php


namespace Modules\Order\Resources\Frontend;

use App\Resources\BaseJsonResource;

class CartResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'items'=>CartItemResource::collection($this->items),
            'coupons'=>$this->coupons,
            'discount_total'=>$this->discount_total
        ];
    }
}
