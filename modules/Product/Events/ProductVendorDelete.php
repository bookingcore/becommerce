<?php


namespace Modules\Product\Events;


use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Product\Models\Vendor\ProductVendor;

class ProductVendorDelete
{
    use SerializesModels,Dispatchable;
    public $product_vendor;

    public function __construct(ProductVendor $product_vendor)
    {
        $this->product_vendor = $product_vendor;
    }
}
