<?php


namespace Modules\Campaign\Listeners;


use Modules\Campaign\Models\CampaignProduct;
use Modules\Product\Models\BaseProduct;

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
    public function handle(BaseProduct $product)
    {
        $this->campaign_product->where('product_id',$product->id)->delete();
    }
}
