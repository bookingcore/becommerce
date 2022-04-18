<?php


namespace Modules\Campaign\Repositories\Eloquents;


use Modules\Campaign\Models\CampaignProduct;
use Modules\Campaign\Repositories\CampaignRepositoryInterface;

class CampaignRepository implements CampaignRepositoryInterface
{

    public $campaign_product;

    public function __construct(CampaignProduct $campaign_product)
    {
        $this->campaign_product = $campaign_product;
    }

    public function listActiveProducts()
    {
        return $this->campaign_product::query()->select(['campaign_products.*'])
        ->join('campaigns',function($join){
            $join->on('campaigns.id','campaign_products.campaign_id');
            $join->where('campaigns.start_date','<=',date('Y-m-d 23:59:59'));
            $join->where('campaigns.end_date','>=',date('Y-m-d'));
        });
    }
}
