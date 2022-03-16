<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZoneMethod extends BaseModel
{
    protected $table = 'product_sz_methods';
    protected $fillable = [
        'title',
        'zone_id',
        'method_id',
        'order',
        'cost',
        'is_enabled'
    ];
    public function methods(){
        return config('product.shipping_methods');
    }
    public function getMethodNameAttribute(){
        $methods = $this->methods();

        return $methods[$this->method_id]['name'] ?? __("Flat rate");
    }

    public function getMethodDescAttribute(){

        $methods = $this->methods();

        return $methods[$this->method_id]['desc'] ?? __("Flat rate");
    }

    public static function countMethodAvailable(){
        return ShippingZoneMethod::where('is_enabled',1)->count();
    }
}
