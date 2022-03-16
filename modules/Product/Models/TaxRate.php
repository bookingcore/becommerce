<?php
namespace Modules\Product\Models;

use App\BaseModel;

class TaxRate extends BaseModel
{
    protected $table = 'product_tax_rates';
    protected $fillable = [
        'country',
        'state',
        'tax_rate',
        'name',
        'priority',
    ];

    public static function taxEnable(){
        return setting_item("tax_enable_calc",0) == 1 ? true : false;
    }
}
