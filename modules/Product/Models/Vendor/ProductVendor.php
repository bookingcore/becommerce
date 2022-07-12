<?php


namespace Modules\Product\Models\Vendor;


use Modules\Product\Models\ProductVariation;

class ProductVendor extends ProductVariation
{

    protected $fillable = [
        'vendor_id',
        'product_id'
    ];
    protected $table = 'product_vendors';
}
