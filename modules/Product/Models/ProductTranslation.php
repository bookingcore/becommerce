<?php

namespace Modules\Product\Models;

use App\BaseModel;

class ProductTranslation extends Product
{
    protected $table = 'product_translations';

    protected $fillable = [
        'title',
        'content',
        'short_desc'
    ];

    protected $slugField     = false;
    protected $seo_type = 'product_translation';

    protected $cleanFields = [
        'content'
    ];

    public function getSeoType(){
        return $this->seo_type;
    }
}