<?php


namespace Modules\Product\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'price_html'=>format_money($this->price),
            'image_url'=>get_file_url($this->image_id,'medium'),
            'variations'=>$this->when(request('need_variations'),VariationResource::collection($this->variations)),
            'text'=>$this->when(request('select2'),$this->title),
            'product_type'=>$this->product_type
        ];
    }
}
