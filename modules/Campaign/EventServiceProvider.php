<?php


namespace Modules\Campaign;


use Modules\Campaign\Listeners\DeleteCampaignProduct;
use Modules\Product\Events\ProductDeleteEvent;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{

    protected $listen = [
        ProductDeleteEvent::class=>[
            DeleteCampaignProduct::class
        ]
    ];
}
