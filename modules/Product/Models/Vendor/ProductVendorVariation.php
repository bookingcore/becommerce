<?php


namespace Modules\Product\Models\Vendor;


use Modules\Product\Models\ProductVariation;

class ProductVendorVariation extends ProductVariation
{
    protected $fillable = [
        'vendor_id',
        'parent_id'
    ];
}
