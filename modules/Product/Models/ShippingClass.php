<?php
namespace Modules\Product\Models;

use App\BaseModel;

class ShippingClass extends BaseModel
{
    protected $table = 'product_shipping_classes';
    protected $fillable = [
        'name',
        'description'
    ];

    protected $slugField     = 'slug';
    protected $slugFromField = 'name';
}
