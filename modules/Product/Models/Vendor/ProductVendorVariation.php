<?php


namespace Modules\Product\Models\Vendor;


use Modules\Product\Models\ProductVariation;

class ProductVendorVariation extends ProductVariation
{

    protected $fillable = [
        'vendor_id',
        'variation_id'
    ];
    protected $table = 'product_vendor_variations';
}
