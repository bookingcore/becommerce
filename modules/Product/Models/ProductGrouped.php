<?php

namespace Modules\Product\Models;

use App\BaseModel;

class ProductGrouped extends BaseModel
{

    protected $table = 'product_grouped';

    protected $fillable = [
        'children_id',
        'parent_id'
    ];

    public static function getTypeName(){
        return __('Grouped Product');
    }
}
