<?php

namespace Modules\Product\Models;

use App\BaseModel;

class ProductGrouped extends BaseModel
{

    const TYPE_GROUPED = 1;
    const TYPE_UP_SELL = 2;
    const TYPE_CROSS_SELL = 3;

    protected $table = 'product_grouped';

    protected $fillable = [
        'children_id',
        'parent_id',
        'group_type'
    ];

    public static function getTypeName(){
        return __('Grouped Product');
    }
}
