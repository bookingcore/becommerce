<?php

namespace Modules\Product\Models;

use App\BaseModel;
class ProductVariation extends BaseModel
{
    protected $table = 'product_variations';
    protected $type = 'product_variation';

    protected $fillable = [
        'title',
        'content',
        'short_desc',
        'status'
    ];

    protected $casts = [
        'dimensions'=>'array'
    ];


    public function getStockStatusCodeAttribute(){
        if(!$this->is_manage_stock){
            return 'in_stock';
        }
        switch ($this->stock_status){
            case 'in':
                return 'in_stock';
                break;
            case 'out':
                return 'out_stock';
                break;

        }
    }
    public function getStockStatusTextAttribute(){
        if(!$this->is_manage_stock){
            return __('In Stock');
        }
        switch ($this->stock_status){
            case 'in':
                return 'in_stock';
                break;
            case 'out':
                return 'out_stock';
                break;

        }
    }


    public function getTermIdsAttribute(){
        return ProductVariationTerm::query()->where('variation_id',$this->id)->get()->pluck('term_id')->toArray();
    }
}