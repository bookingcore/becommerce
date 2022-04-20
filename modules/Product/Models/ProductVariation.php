<?php

namespace Modules\Product\Models;

use App\BaseModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Core\Models\Term;

class ProductVariation extends BaseModel
{
    protected $table = 'product_variations';
    public $type = 'product_variation';

    protected $fillable = [
        'title',
        'content',
        'short_desc',
        'status'
    ];

    protected $casts = [
        'dimensions'=>'array',
        'price'=>'float'
    ];

    public static function getModelName()
    {
        return __("ProductVariation");
    }

    public static function getTypeName()
    {
        return __("Variable Product");
    }

    public function variation_terms(){
        return $this->hasMany(ProductVariationTerm::class,'variation_id','id');
    }
    public function terms(){
        $ids = $this->variation_terms->pluck('term_id')->all();
        if(empty($ids)) return null;

        return Term::query()->whereIn('id',$ids)->with(['attribute'])->get();
    }

    public function getDetailUrl($locale = false)
    {
        return route('product.detail',['slug'=>'sleeve-linen-blend-caro-pane-shirt']);
    }


    public function getStockStatusCodeAttribute(){
        if(!$this->check_manage_stock()){
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
        if(!$this->check_manage_stock()){
            return __('In Stock');
        }
        switch ($this->stock_status){
            case 'in':
                return __("In Stock");
                break;
            case 'out':
                return __("Out Stock");
                break;

        }
    }


    public function getTermIdsAttribute(){
        return ProductVariationTerm::query()->where('variation_id',$this->id)->get()->pluck('term_id')->toArray();
    }

    public function getStockStatus(){
        $stock = ''; $in_stock = true;
        if ($this->check_manage_stock()){
            if ($this->stock_status == 'in'){
                $stock = __(':count in stock',['count'=>$this->quantity]);
            }
        } else {
            if (  $this->stock_status == 'out'){
                $stock = __('Out Of Stock');
                $in_stock = false;
            }else{
                $stock = __('In Stock');
            }
        }
        return [
            'stock'     =>  $stock,
            'in_stock'  =>  $in_stock
        ];
    }

    public function isActive($parent_manage = false){
        if(empty($this->active)){
            return false;
        }
        if($parent_manage == false){
            if ($this->check_manage_stock()){
                // get booking and check out of

                //return false;
            }else if ($this->stock_status == 'out'){
                return false;
            }
        }
        return true;
    }

    public function getAttributesForDetail($parent_manage = false)
    {
        return [
            'product_id'      => $this->product_id,
            'shipping_class'  => $this->shipping_class,
            'name'            => $this->name,
            'position'        => $this->position,
            'sku'             => $this->sku,
            'image'           => get_file_url($this->image_id, "full") ?? "",
            'price'           => format_money($this->price),
            'sold'            => $this->sold,
            'quantity'        => $parent_manage == false ? $this->quantity : null,
            'is_manage_stock' => $parent_manage == false ? $this->check_manage_stock() : 0,
            'stock'           => $this->getStockStatus(),
        ];
    }

}
