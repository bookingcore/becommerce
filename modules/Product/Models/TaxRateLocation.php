<?php
namespace Modules\Product\Models;

use App\BaseModel;

class TaxRateLocation extends BaseModel
{
    protected $table = 'product_tax_locations';
    protected $fillable = [
        'tax_rate_id',
        'location_code',
        'location_type'
    ];

}
