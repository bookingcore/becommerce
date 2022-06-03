<?php

namespace Modules\Product\Models;

use App\BaseModel;

class ProductTranslation extends BaseModel
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

    protected $casts = [];

    public function getSeoType(){
        return $this->seo_type;
    }
}
