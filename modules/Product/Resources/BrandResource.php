<?php


namespace Modules\Product\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{

    public function toArray($request)
    {
        $translation = $this->translate();
        return [
            'id'=>$this->id,
            'name'=>$translation->name,
        ];
    }
}
