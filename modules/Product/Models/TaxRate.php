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

    protected $casts = [
        'tax_rate'=>'float'
    ];

    public static function isEnable(){
        return setting_item("tax_enable_calc",0) == 1 ? true : false;
    }
    public static function isPriceInclude(){
        return setting_item("prices_include_tax",'yes') == 'yes';
    }
}
