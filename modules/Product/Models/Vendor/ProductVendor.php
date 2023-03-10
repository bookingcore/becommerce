<?php


namespace Modules\Product\Models\Vendor;


use Modules\Product\Events\ProductVendorDelete;
use Modules\Product\Models\ProductVariation;

class ProductVendor extends ProductVariation
{

    protected $fillable = [
        'vendor_id',
        'product_id'
    ];

    public function delete()
    {
        ProductVendorDelete::dispatch($this);

        return parent::delete(); // TODO: Change the autogenerated stub
    }
}
