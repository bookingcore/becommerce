<?php


namespace Modules\Product\Traits\Vendor;


use Modules\Product\Models\Vendor\ProductVendor;

trait HasProductVendor
{
    public function current_product_vendor(){
        return $this->hasOne(ProductVendor::class,'product_id')->where('vendor_id',auth()->id());
    }
}
