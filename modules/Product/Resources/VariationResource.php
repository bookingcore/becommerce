<?php


namespace Modules\Product\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
{

    public function toArray($request)
    {
        $terms = $this->terms();
        $name = $terms ? (implode(', ',$terms->pluck('name')->get())) : '';
        return [
            'id'=>$this->id,
            'price'=>$this->price,
            'name'=> $name.'- #'.$this->id
        ];
    }
}
