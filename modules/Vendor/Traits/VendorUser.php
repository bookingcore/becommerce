<?php


namespace Modules\Vendor\Traits;


use Modules\Product\Models\Vendor\ProductVendor;
use Modules\Product\Models\Vendor\ProductVendorVariation;

trait VendorUser
{
    public function getVendorMode(){
        $meta = $this->getMeta('vendor_mode');
        return !$meta ? setting_item('vendor_mode') : $meta;
    }
    public function vendor_variations(){
        return $this->hasMany(ProductVendorVariation::class,'vendor_id');
    }
    public function vendor_products(){
        return $this->hasMany(ProductVendor::class,'vendor_id');
    }

}
