<?php

namespace Modules\Product\Models;

use App\BaseModel;
use Modules\Core\Models\Attributes;

class ProductVariationTerm extends BaseModel
{
    protected $table = 'product_variation_term';

    protected $fillable = [
        'variation_id','term_id','product_id'
    ];

    public function get_term($product_id){
        $variations_id = [];
        $variations = ProductVariation::where('product_id',$product_id)->get();
        if (!empty($variations)){
            foreach ($variations as $item){
                array_push($variations_id,$item->id);
            }
        }
        $term = ProductVariationTerm::whereIn('variation_id',$variations_id)->get();
        $term_id = [];
        if (!empty($term)){
            foreach ($term as $item){
                array_push($term_id, $item->term_id);
            }
        }
        $variations_attr = BravoTerms::select('id','name','attr_id')->whereIn('id',$term_id)->get();

        return $variations_attr;
    }

    public function get_attrs($product_id){
        $variations_attr = $this->get_term($product_id);
        $attrs = Attributes::select('id','name')->get();
        $newAttrs = [];
        if (!empty($attrs)){
            foreach ($attrs as $item){
                $v_name = [];
                foreach ($variations_attr as $v_item){
                    if ($item->id == $v_item->attr_id){
                        dump($v_item);
                        array_push($v_name, $v_item->name);
                    }
                }
                array_push($newAttrs, [
                    'name'  =>  $item->name,
                    'attr'  =>  $v_name
                ]);
            }
        }
    }
}
