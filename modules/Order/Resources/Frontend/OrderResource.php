<?php
namespace Modules\Order\Resources\Frontend;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Models\ShippingZoneMethod;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'subtotal_amount' => $this::subtotal(),
            'discount_amount' => $this::discountTotal(),
            'shipping_available' => ShippingZoneMethod::countMethodAvailable() == 0 ? false : true,
            'tax' => "",
        ];
    }
}
