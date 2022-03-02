<?php


namespace Modules\Product\Traits;


use Modules\Product\Models\UserAddress;

trait HasAddress
{

    public function billing_address(){
        return $this->hasOne(UserAddress::class,'user_id')->where('address_type',1)->where('is_default',1);
    }

    public function billing_addresses(){
        return $this->hasMany(UserAddress::class,'user_id')->where('address_type',1);
    }

    public function shipping_address(){
        return $this->hasOne(UserAddress::class,'user_id')->where('address_type',2)->where('is_default',1);
    }
    public function shipping_addresses(){
        return $this->hasMany(UserAddress::class,'user_id')->where('address_type',2);
    }
}
