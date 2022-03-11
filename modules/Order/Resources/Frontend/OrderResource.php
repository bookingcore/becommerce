<?php
namespace Modules\Order\Resources\Frontend;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'subtotal_amount' => $this::subtotal(),
            'discount_amount' => $this::discountTotal(),
            'tax' => "",
        ];
    }
}
