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

    public function isActiveNow(){
        if($this->status != 'active') return false;
        if($this->start_date > time()) return false;
        if($this->end_date < time()) return false;
        return true;
    }

    public function getPriceAttribute(){
        $price = $this->product->price ?? '';
        return $price;
    }
    public function getDiscountedPriceAttribute(){
        $price = $this->price ?? 0;
        if($this->discount_amount){
            $price -= $price * $this->discount_amount / 100;
        }
        return $price;
    }

}
