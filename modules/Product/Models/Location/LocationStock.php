<?php


namespace Modules\Product\Models\Location;


use App\BaseModel;

class LocationStock extends BaseModel
{
    protected $fillable = [
        'location_id',
        'product_id',
    ];
    protected $table = 'location_product_stocks';
}
