<?php


namespace Themes\Axtronic\Models;


use Themes\Axtronic\Database\Factories\ProductBrandFactory;

class ProductBrand extends \Modules\Product\Models\ProductBrand
{

    protected static function newFactory()
    {
        return new ProductBrandFactory();
    }
}
