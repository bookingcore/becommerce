<?php

namespace Modules\Product\Models;

use Modules\Core\Models\Attribute;

class ProductAttr extends Attribute
{
    public static function search(){
        return parent::query()->where('status','publish')->where('service', 'product')->orderBy('position')->orderByDesc('id');
    }

}
