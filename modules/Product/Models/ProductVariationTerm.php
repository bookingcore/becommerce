<?php

namespace Modules\Product\Models;

use App\BaseModel;

class ProductVariationTerm extends BaseModel
{
    protected $table = 'product_variation_term';

    protected $fillable = [
        'variation_id','term_id','product_id'
    ];

}