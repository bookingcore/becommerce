<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ProductTerm extends BaseModel
{
    protected $table = 'product_term';
    protected $fillable = [
        'term_id',
        'target_id'
    ];
}