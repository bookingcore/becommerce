<?php


namespace Modules\Campaign\Repositories\Eloquents;


use Modules\Campaign\Models\Campaign;
use Modules\Campaign\Models\CampaignProduct;
use Modules\Campaign\Repositories\Contracts\CampaignRepositoryInterface;

class CampaignRepository implements CampaignRepositoryInterface
{

    public $campaign_product;
    public $campaign;

    public function __construct(CampaignProduct $campaign_product,Campaign $campaign)
    {
        $this->campaign_product = $campaign_product;
        $this->campaign = $campaign;
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

    public function listSaleEndProducts()
    {
        return $this->campaign_product::query()->select(['campaign_products.*'])
        ->join('campaigns',function($join){
            $join->on('campaigns.id','campaign_products.campaign_id');
            $join->where('campaigns.start_date','<=',date('Y-m-d 23:59:59'));
            $join->where('campaigns.end_date','>=',date('Y-m-d'));
        });
    }

    public function search($filters = [])
    {
        $query =  $this->campaign::query();
        if(!empty($filters['s']))
        {
            $query->where('name', 'LIKE', '%' . $filters['s'] . '%');
        }

        $query->orderBy($filters['order_by'] ?? 'id',$filters['order'] ?? 'desc');

        return $query;
    }
}
