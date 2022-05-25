<?php


namespace Modules\Product\Listeners;


use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;

class DeleteVariation
{
    protected $productVariation;
    public function __construct(ProductVariation $productVariation)
    {
        $this->productVariation = $productVariation;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProductDeleteEvent $product_delete_event)
    {
        $product = $product_delete_event->product;
        $this->productVariation->where('product_id',$product->id)->delete();
    }
}
