<?php


namespace Modules\User\Resources;


use App\Resources\BaseJsonResource;
use Modules\Product\Resources\ProductResource;

class UserOrderItemResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'object_id'=>$this->object_id,
            'qty'=>$this->qty,
            'vendor'=>$this->vendor ? new UserResource($this->vendor) : null,
            'product'=>$this->model ? new ProductResource($this->model) : null,
            'price'=>$this->price,
            'status'=>$this->status
        ];
    }
}
