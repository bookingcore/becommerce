<?php


namespace Modules\Product\Traits\Location;


use Modules\Product\Models\Location\LocationStock;

trait HasLocationVariationStock
{
    public function location_stocks(){
        return $this->hasMany(LocationStock::class,'variation_id')->where('stock_type',$this->location_stock_type)->where('product_id',$this->product_id);
    }
}
