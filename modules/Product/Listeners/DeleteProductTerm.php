<?php


namespace Modules\Product\Listeners;


use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductVariation;

class DeleteProductTerm
{
    protected $productTerm;
    public function __construct(ProductTerm $productTerm)
    {
        $this->productTerm = $productTerm;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProductDeleteEvent $product_delete_event)
    {
        $product = $product_delete_event->product;
        $this->productTerm->where('target_id',$product->id)->delete();
    }
}
