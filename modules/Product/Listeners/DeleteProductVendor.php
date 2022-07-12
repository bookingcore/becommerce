<?php


namespace Modules\Product\Listeners;


use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\Vendor\ProductVendor;
use Modules\Product\Models\Vendor\ProductVendorVariation;

class DeleteProductVendor
{
    protected $product_vendor;

    public function __construct(ProductVendor $product_vendor)
    {
        $this->product_vendor = $product_vendor;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProductDeleteEvent $product_delete_event)
    {
        $product = $product_delete_event->product;
        $this->product_vendor->where('product_id',$product->id)->delete();
    }
}
