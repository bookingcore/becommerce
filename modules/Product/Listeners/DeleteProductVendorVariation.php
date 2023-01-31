<?php


namespace Modules\Product\Listeners;


use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Events\ProductVendorDelete;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\Vendor\ProductVendor;
use Modules\Product\Models\Vendor\ProductVendorVariation;

class DeleteProductVendorVariation
{
    protected $product_vendor;
    protected $product_vendor_variation;

    public function __construct(ProductVendor $product_vendor,ProductVendorVariation $product_vendor_variation)
    {
        $this->product_vendor = $product_vendor;
        $this->product_vendor_variation = $product_vendor_variation;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProductVendorDelete $product_delete_event)
    {
        $product_vendor = $product_delete_event->product_vendor;
        $this->product_vendor_variation->where('product_id',$product_vendor->product_id)->delete();
    }
}
