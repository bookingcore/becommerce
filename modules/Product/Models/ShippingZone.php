<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZone extends BaseModel
{
    protected $table = 'product_shipping_zones';
    protected $fillable = [
        'name',
        'order'
    ];

    public static function getModelName()
    {
        return __("Shipping Zones");
    }
}
