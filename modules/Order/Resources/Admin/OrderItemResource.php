<?php


namespace Modules\Order\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
        ];
    }

}
