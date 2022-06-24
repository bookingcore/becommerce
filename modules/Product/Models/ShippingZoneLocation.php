<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZoneLocation extends BaseModel
{
    protected $table = 'product_shipping_zone_locations';
    protected $fillable = [
        'zone_id',
        'location_code'
    ];

}
