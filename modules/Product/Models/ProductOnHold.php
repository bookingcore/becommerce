<?php


namespace Modules\Product\Models;


use App\BaseModel;

class ProductOnHold extends BaseModel
{
    protected $table ='product_on_hold';
    protected $fillable = [
        'product_id','variant_id','order_id','qty', 'expired_at'
    ];

}
