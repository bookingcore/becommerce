<?php
namespace Modules\Product\Models;

use App\BaseModel;

class TaxRate extends BaseModel
{
    protected $table = 'product_tax_rates';
    protected $fillable = [
        'country_code',
        'state',
        'tax_rate',
        'name',
        'priority',
        'compound',
        'shipping',
        'tax_rate_class'
    ];

    public function getClassNameAttribute(){
        $taxRateClasses = [
            'standard' => __("Standard"),
            'reduced_rate' => __("Reduced rate"),
            'zero_rate' => __("Zero rate")
        ];

        return $taxRateClasses[$this->tax_rate_class] ?? __("Standard");
    }

    public function locations(){
        return $this
            ->hasMany(TaxRateLocation::class,'tax_rate_id','id');
    }

    public function locationCities(){
        return $this
            ->hasMany(TaxRateLocation::class,'tax_rate_id','id')
            ->where('location_type', '=','city');
    }

    public function locationPostcodes(){
        return $this
            ->hasMany(TaxRateLocation::class,'tax_rate_id','id')
            ->where('location_type', '=','postcode');
    }

}
