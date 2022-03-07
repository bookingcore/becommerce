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

    public function calculateShipping($params){
        dd($params);
        // tìm shipping by country
        $zone_location = ShippingZoneLocation::where("location_code",$params['country'])->get();

        //Lấy item trong cart ra xem có shipping class k
        // lấy shipping amount
        // save shippong to cart
    }

}
