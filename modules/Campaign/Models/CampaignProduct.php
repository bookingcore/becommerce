<?php


namespace Modules\Campaign\Models;


use App\BaseModel;
use Modules\Product\Models\Product;

class CampaignProduct extends BaseModel
{

    protected $table = 'campaign_products';

    protected $fillable = [
        'product_id',
        'campaign_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
