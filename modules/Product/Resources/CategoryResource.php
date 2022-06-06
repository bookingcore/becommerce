<?php


namespace Modules\Product\Resources;


use App\Resources\BaseJsonResource;

class CategoryResource extends BaseJsonResource
{
    public function toArray($request)
    {
        $translation = $this->translate();
        return [
            'id'=>$this->id,
            'name'=>$translation->name,
            'children'=> CategoryResource::collection($this->children),
            'count'=>$this->whenNeed('count',function(){
                return $this->products_count;
            })
        ];
    }

}
