<?php


namespace Modules\Order\Models;


use App\BaseModel;

class OrderItemMeta extends BaseModel
{
    protected $table = 'core_order_item_meta';

    protected $fillable = [
        'name' ,
        'val'  ,
        'order_item_id',
    ];
}
