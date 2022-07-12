<?php


namespace Themes\Axtronic\Models;


use Themes\Axtronic\Database\Factories\ProductTagFactory;

class ProductTag extends \Modules\Product\Models\ProductTag
{

    protected static function newFactory()
    {
        return new ProductTagFactory();
    }
}
