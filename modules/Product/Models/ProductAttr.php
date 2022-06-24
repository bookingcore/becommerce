<?php

namespace Modules\Product\Models;

use Modules\Core\Models\Attribute;

class ProductAttr extends Attribute
{
    public static function search($filters = []){

        $query = parent::query()->where('status','publish')->where('service', 'product')->orderBy('position')->orderByDesc('id');

        if(!empty($filters['ids']))
        {
            $query->whereIn(parent::qualifyColumn('id'),$filters['ids']);
            $query->orderByRaw("FIELD(id,".implode("," ,array_fill(0,count($filters['ids']),'?')).")",$filters['ids']);
        }
        return $query;
    }

}
