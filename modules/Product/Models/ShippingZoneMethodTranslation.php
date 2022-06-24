<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingZoneMethodTranslation extends BaseModel
{
    protected $table = 'product_sz_method_translations';
    protected $fillable = [
        'title'
    ];
}
