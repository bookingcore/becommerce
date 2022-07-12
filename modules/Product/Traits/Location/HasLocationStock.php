<?php


namespace Modules\Product\Traits\Location;


use Modules\Product\Models\Location\LocationStock;

trait HasLocationStock
{
    public function location_stocks(){
        return $this->hasMany(LocationStock::class,'product_id');
    }
}
