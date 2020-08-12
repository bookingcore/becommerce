<?php

namespace Modules\Product\Models;

class BravoTerms extends BaseProduct
{
    protected $table = 'bravo_terms';

    protected $fillable = [
        'id',
        'name',
        'attr_id',
        'slug'
    ];
}
