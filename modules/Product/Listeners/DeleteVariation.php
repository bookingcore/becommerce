<?php


namespace Modules\Product\Listeners;


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
    public function handle(Product $product)
    {
        $this->productVariation->where('product_id',$product->id)->delete();
    }
}
