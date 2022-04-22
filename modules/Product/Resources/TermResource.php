<?php


namespace Modules\Product\Resources;


use App\Resources\BaseJsonResource;

class TermResource extends BaseJsonResource
{

    public function toArray($request)
    {
        $translation = $this->translate();
        return [
            'id'=>$this->id,
            'name'=>$translation->name,
            'content'=>$this->content
        ];
    }

}
