<?php

namespace Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariationMappingResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->variationMappingResource();
    }
}
