<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingClassTranslation extends BaseModel
{
    protected $table = 'product_shipping_class_translations';
    protected $fillable = [
        'name',
        'description'
    ];
}
