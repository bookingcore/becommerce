<?php


namespace Modules\Product\Models\Vendor;


use Modules\Product\Models\ProductVariation;

class ProductVendorVariation extends ProductVariation
{

    protected $table = 'product_variations';

    public function product_vendor(){
        return $this->belongsTo(ProductVendor::class,'product_id')->where('vendor_id',$this->vendor_id);
    }

    public static function boot(){
        static::saving(function($data){
            $data->variation_type = ProductVariation::TYPE_VENDOR_VARIATION;
        });
    }
}
