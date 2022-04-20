<?php


namespace Modules\Product\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $translation = $this->translate();
        return [
            'id'=>$this->id,
            'title'=>$translation->title,
            'children'=> CategoryResource::collection($this->children)
        ];
    }

}
