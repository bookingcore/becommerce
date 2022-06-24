<?php


namespace Modules\Product\Resources;


use App\Resources\BaseJsonResource;

class AttributeResource extends BaseJsonResource
{
    public function toArray($request)
    {
        $translation = $this->translate();
        return [
            'id'=>$this->id,
            'name'=>$translation->name,
            'type'=>$this->type,
            'terms'=>$this->whenNeed('terms',function(){
                return TermResource::collection($this->terms);
            })
        ];
    }

}
