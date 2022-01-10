<?php
namespace Modules\Product\Models;

use App\BaseModel;

class TaxRateTranslation extends BaseModel
{
    protected $table = 'product_tax_rate_translations';
    protected $fillable = [
        'name'
    ];
}
