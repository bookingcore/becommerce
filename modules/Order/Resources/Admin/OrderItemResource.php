<?php


namespace Modules\Order\Resources\Admin;


use App\Resources\BaseJsonResource;
use Modules\Product\Resources\ProductResource;

class OrderItemResource extends BaseJsonResource
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
            'product'=> $model ? new ProductResource($model,['variations','price']) : null,
            'variation_id'=>$this->variation_id
        ];
    }

}
