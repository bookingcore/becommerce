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
            'name'=>$translation->name,
            'children'=> CategoryResource::collection($this->children)
        ];
    }

}
