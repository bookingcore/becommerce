<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/23/2019
 * Time: 4:30 PM
 */
namespace Modules\Product\Models;

use App\BaseModel;

class  ProductCategoryRelation extends BaseModel
{
    protected $table = 'product_category_relations';
    protected $fillable = [
        'cat_id',
        'target_id'
    ];


}