<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ProductCategoryTranslation extends BaseModel
{
    protected $table = 'product_category_translations';
    protected $fillable = [
        'name',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}