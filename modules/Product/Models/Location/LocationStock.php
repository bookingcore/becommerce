<?php


namespace Modules\Product\Models\Location;


use App\BaseModel;

class LocationStock extends BaseModel
{
    const TYPE_PRODUCT = 0;
    const TYPE_PRODUCT_VARIATION = 1;

    protected $fillable = [
        'location_id',
        'product_id',
        'stock_type'
    ];
    protected $table = 'location_product_stocks';
}
