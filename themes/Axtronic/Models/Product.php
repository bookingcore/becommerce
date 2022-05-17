<?php


namespace Themes\Axtronic\Models;


use Themes\Axtronic\Database\Factories\ProductFactory;

class Product extends \Modules\Product\Models\Product
{

    protected static function newFactory()
    {
        return new ProductFactory();
    }
}
