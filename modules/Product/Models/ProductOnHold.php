<?php


namespace Modules\Product\Models;


use Illuminate\Database\Eloquent\Model;

class ProductOnHold extends Model
{
    protected $table ='product_on_hold';

    protected $fillable = [
        'product_id','variant_id','order_id','qty', 'expired_at'
    ];

}
