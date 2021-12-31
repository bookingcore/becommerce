<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZoneMethod extends BaseModel
{
    protected $table = 'product_shipping_zone_methods';
    protected $fillable = [
        'zone_id',
        'method_id',
        'order',
        'is_enabled'
    ];
}
