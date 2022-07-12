<?php


namespace Modules\Campaign;


use Modules\Campaign\Listeners\DeleteCampaignProduct;
use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Listeners\DeleteProductTerm;
use Modules\Product\Listeners\DeleteVariation;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{

    protected $listen = [
        ProductDeleteEvent::class=>[
            DeleteCampaignProduct::class,
        ]
    ];
}
