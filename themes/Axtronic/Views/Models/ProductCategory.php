<?php


namespace Themes\Axtronic\Models;


use Themes\Axtronic\Database\Factories\ProductCategoryFactory;

class ProductCategory extends \Modules\Product\Models\ProductCategory
{

    protected static function newFactory()
    {
        return new ProductCategoryFactory();
    }
}
