<?php


namespace Modules\Product;


use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Events\ProductVendorDelete;
use Modules\Product\Listeners\DeleteProductTerm;
use Modules\Product\Listeners\DeleteProductVendor;
use Modules\Product\Listeners\DeleteProductVendorVariation;
use Modules\Product\Listeners\DeleteVariation;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{

    protected $listen = [
        ProductDeleteEvent::class=>[
            DeleteVariation::class,
            DeleteProductTerm::class,
            DeleteProductVendor::class
        ],
        ProductVendorDelete::class=>[
            DeleteProductVendorVariation::class
        ],
    ];
}
