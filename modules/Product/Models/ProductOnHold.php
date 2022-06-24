<?php


namespace Modules\Product\Models;


use App\BaseModel;
use Modules\Order\Models\Order;

class ProductOnHold extends BaseModel
{
    protected $table ='product_on_hold';
    protected $fillable = [
        'product_id','variant_id','order_id','qty', 'expired_at'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

}
