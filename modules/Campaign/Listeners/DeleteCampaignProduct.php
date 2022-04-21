<?php


namespace Modules\Campaign\Listeners;


use Modules\Campaign\Models\CampaignProduct;
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
    public function handle(Product $product)
    {
        $this->campaign_product->where('product_id',$product->id)->delete();
    }
}
