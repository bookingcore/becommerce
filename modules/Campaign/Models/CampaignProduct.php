<?php


namespace Modules\Campaign\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Product\Models\Product;

class CampaignProduct extends BaseModel
{

    protected $table = 'campaign_products';

    protected $fillable = [
        'product_id',
        'campaign_id'
    ];
    protected $casts  = [
        'start_date'=>'date',
        'end_date'=>'date',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function isActiveNow(){
        if($this->status != 'active') return false;
        if($this->start_date->timestamp > time()) return false;
        if($this->end_date->timestamp < time()) return false;
        return true;
    }
    public function price() : Attribute{
        return Attribute::make(
            get:function($value){
                $price = $this->product->price ?? '';
                return $price;
            }
        );
    }
    public function discountedPrice(): Attribute{

        return Attribute::make(
            get:function($value){
                $price = $this->price ?? 0;
                if($this->discount_amount){
                    $price -= $price * $this->discount_amount / 100;
                }
                return $price;
            }
        );
    }
}
