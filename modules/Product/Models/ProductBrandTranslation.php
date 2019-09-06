<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ProductBrandTranslation extends BaseModel
{
    protected $table = 'product_brand_translations';
    protected $fillable = [
        'name',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}