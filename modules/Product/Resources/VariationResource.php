<?php


namespace Modules\Product\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
{

    public function toArray($request)
    {
        $terms = $this->terms();
        $name = $terms ? (implode(', ',$terms->pluck('name')->all())) : '';
        return [
            'id'=>$this->id,
            'price'=>$this->price,
            'name'=> $name.' - #'.$this->id,
            'remain_stock'=>$this->remain_stock,
            'stock_status'=>$this->stock_status,
            'is_manage_stock'=>$this->is_manage_stock,
        ];
    }
}
