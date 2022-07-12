<?php


namespace Themes\Freshen\Models;


use Themes\Freshen\Database\Factories\ProductCategoryFactory;

class ProductCategory extends \Modules\Product\Models\ProductCategory
{

    protected static function newFactory()
    {
        return new ProductCategoryFactory();
    }
}
