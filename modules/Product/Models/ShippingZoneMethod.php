<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZoneMethod extends BaseModel
{
    protected $table = 'product_shipping_zone_methods';
    protected $fillable = [
        'title',
        'zone_id',
        'method_id',
        'order',
        'is_enabled'
    ];

    public function getMethodNameAttribute(){
        $methods = [
            'flat_rate' => __("Flat rate"),
            'free_shipping' => __("Free shipping"),
            'local_pickup' => __("Local pickup")
        ];

        return $methods[$this->method_id] ?? __("Flat rate");
    }

    public function getMethodDescAttribute(){
        $methods = [
            'flat_rate' => __("Lets you charge a fixed rate for shipping."),
            'free_shipping' => __("Free shipping is a special method which can be triggered with coupons and minimum spends."),
            'local_pickup' => __("Allow customers to pick up orders themselves. By default, when using local pickup store base taxes will apply regardless of customer address.")
        ];

        return $methods[$this->method_id] ?? __("Flat rate");
    }
}
