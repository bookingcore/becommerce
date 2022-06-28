<?php

namespace Modules\Product\Models;

use App\BaseModel;

class ProductGrouped extends BaseModel
{

    protected $table = 'product_grouped';

    public static function getTypeName(){
        return __('Grouped Product');
    }
}
