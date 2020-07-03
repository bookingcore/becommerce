<?php

namespace Modules\Product\Models;

class ProductAttrs extends BaseProduct
{
    protected $table = 'bravo_attrs';

    protected $fillable = [
        'name',
        'slug',
        'service'
    ];
}
