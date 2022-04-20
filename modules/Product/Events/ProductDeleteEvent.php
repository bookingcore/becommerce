<?php
namespace Modules\Product\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Modules\Product\Models\Product;
use Illuminate\Queue\SerializesModels;

class ProductDeleteEvent
{
    use SerializesModels,Dispatchable;
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
