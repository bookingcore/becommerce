<?php


namespace Modules\Product\Traits\Vendor;


use App\User;
use Modules\Product\Models\Vendor\ProductVendor;
use Modules\Product\Models\Vendor\ProductVendorVariation;

trait HasProductVendor
{
    public function current_product_vendor(){
        return $this->hasOne(ProductVendor::class,'product_id')->where('variation_type',ProductVendorVariation::TYPE_VENDOR)->where('vendor_id',auth()->id());
    }


    public function product_vendors(){
        return $this->hasMany(ProductVendor::class,'product_id')->where('variation_type',ProductVendorVariation::TYPE_VENDOR);
    }

    public function vendor_variations(){
        return $this->hasMany(ProductVendorVariation::class,'product_id')->where('variation_type',ProductVendorVariation::TYPE_VENDOR_VARIATION);
    }
}
