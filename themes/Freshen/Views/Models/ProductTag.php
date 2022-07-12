<?php


namespace Themes\Freshen\Models;


use Themes\Freshen\Database\Factories\ProductTagFactory;

class ProductTag extends \Modules\Product\Models\ProductTag
{

    protected static function newFactory()
    {
        return new ProductTagFactory();
    }
}
