<?php


namespace Modules\Order\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Resources\ProductResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        $model = $this->model;
        return [
            'id'=>$this->id,
            'product_id'=>$this->object_id,
            'qty'=>$this->qty,
            'price'=>$this->price,
            'title'=>!empty($model->title) ? $model->title.' - #'.$this->object_id : '',
            'product'=> $model ? New ProductResource($model) : null
        ];
    }

}
