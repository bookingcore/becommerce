<?php


namespace Modules\Product\Resources;


use App\Resources\BaseJsonResource;

class ProductResource extends BaseJsonResource
{

    public function toArray($request)
    {
        $translation = $this->translate(app()->getLocale());
        return [
            'id'=>$this->id,
            'title'=>$translation->title,
            'price'=>$this->price,
            'price_html'=>format_money($this->price),
            'image_url'=>get_file_url($this->image_id,'medium'),
            'variations'=>$this->whenNeed('variations',function(){
                return VariationResource::collection($this->variations);
            }),
            'text'=>$this->when(request('select2'),$this->title.' - #'.$this->id),
            'product_type'=>$this->product_type,
            'remain_stock'=>$this->remain_stock,
            'stock_status'=>$this->stock_status,
            'is_manage_stock'=>$this->is_manage_stock,
        ];
    }
}
