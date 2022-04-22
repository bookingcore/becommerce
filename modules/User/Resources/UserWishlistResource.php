<?php


namespace Modules\User\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Resources\ProductResource;

class UserWishlistResource extends JsonResource
{

    public function toArray($request)
    {
        $service = $this->service;
        return new ProductResource($service);
    }
}
