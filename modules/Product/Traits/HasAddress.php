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

    public function save_default_address($data,$type){
        $add = $type === UserAddress::BILLING  ? $this->billing_address : $this->shipping_address;
        if(!$add){
            $add = new UserAddress();
            $add->user_id = $this->id;
            $add->is_default = 1;
        }
        $add->fill($data);
        $add->type = $type;
        $add->save();
    }
}
