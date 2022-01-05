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

    public function locations(){
        return $this->hasMany(ShippingZoneLocation::class,'zone_id','id');
    }

    public function shippingMethods(){
        return $this->hasMany(ShippingZoneMethod::class,'zone_id','id');
    }
}
