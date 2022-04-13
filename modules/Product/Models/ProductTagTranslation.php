<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Modules\News\Models\News;
use Modules\News\Models\NewsTag;

class ProductTagTranslation extends BaseModel
{
    protected $table = 'product_tag_translations';
    protected $fillable      = [
        'name',
        'content',
    ];
}
