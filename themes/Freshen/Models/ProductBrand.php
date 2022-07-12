<?php


namespace Themes\Freshen\Models;


use Themes\Freshen\Database\Factories\ProductBrandFactory;

class ProductBrand extends \Modules\Product\Models\ProductBrand
{

    protected static function newFactory()
    {
        return new ProductBrandFactory();
    }
}
