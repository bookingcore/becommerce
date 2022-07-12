<?php


namespace Themes\Freshen\Models;


use Themes\Freshen\Database\Factories\ProductFactory;

class Product extends \Modules\Product\Models\Product
{

    protected static function newFactory()
    {
        return new ProductFactory();
    }
}
