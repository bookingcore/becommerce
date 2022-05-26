<?php


namespace Modules\Campaign\Listeners;


use Modules\Campaign\Models\CampaignProduct;
use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Models\Product;

class DeleteCampaignProduct
{
    protected $campaign_product;
    public function __construct(CampaignProduct $campaign_product)
    {
        $this->campaign_product = $campaign_product;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(ProductDeleteEvent $product_delete_event)
    {
        $product = $product_delete_event->product;
        $this->campaign_product->where('product_id',$product->id)->delete();
    }
}
