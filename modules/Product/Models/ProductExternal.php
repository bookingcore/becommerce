<?php

namespace Modules\Product\Models;

class ProductExternal extends Product
{

    public static function getTypeName()
    {
        return __("External Product");
    }
}
