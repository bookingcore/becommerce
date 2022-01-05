<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZoneMethodTranslation extends BaseModel
{
    protected $table = 'product_shipping_zone_method_translations';
    protected $fillable = [
        'title'
    ];
}
