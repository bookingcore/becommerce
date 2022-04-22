<?php


namespace Modules\Product\Resources;


use App\Resources\BaseJsonResource;
use Modules\User\Resources\UserResource;

class ProductResource extends BaseJsonResource
{

    public function toArray($request)
    {
        $translation = $this->translate(app()->getLocale());
        return [
            'id'=>$this->id,
            'title'=>$translation->title,
            'price'=>$this->whenNeed('price',function(){
                return $this->sale_price;
            }),
            'origin_price'=>$this->origin_price,
            'sku'=>$this->sku,
            'price_html'=>$this->whenNeed('price',function(){
                return format_money($this->sale_price);
            }),
            'image_url'=>get_file_url($this->image_id,'medium'),
            'variations'=>$this->whenNeed('variations',function(){
                return VariationResource::collection($this->variations);
            }),
            'text'=>$this->when(request('select2'),$this->title.' - #'.$this->id),
            'product_type'=>$this->product_type,
            'remain_stock'=>$this->whenNeed('remain_stock',function(){
                return $this->remain_stock;
            }),
            'stock_status'=>$this->stock_status,
            'is_manage_stock'=>$this->is_manage_stock,
            'content'=>$this->whenNeed('content',$this->content),
            'review_data'=>$this->whenNeed('review_data',function(){
                return $this->getScoreReview();
            }),
            'categories'=>$this->whenNeed('categories',function(){
                return CategoryResource::collection($this->categories);
            }),
            'tags'=>$this->whenNeed('tags',function(){
                return TagResource::collection($this->tags);
            }),
            'author'=>$this->whenNeed('author',function(){
                return new UserResource($this->author);
            }),
            'gallery'=>$this->whenNeed('gallery',function(){
                return $this->getGallery();
            })
        ];
    }
}
