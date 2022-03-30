<?php

namespace Modules\Product\Models;

use App\BaseModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Modules\Core\Models\Term;

class ProductVariation extends BaseProduct
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
        if(!$this->is_manage_stock()){
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
        if(!$this->is_manage_stock()){
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

    public function addToCart(Request $request)
    {
        $quantity = (!empty($request->input('qty'))) ? $request->input('qty') : 1;
        $variation_id = $request->input('variation_id');
        $product_name = '';
        $stock = $add = 0;
        if($variation_id){
            $variation = ProductVariation::find($variation_id);
            $product = Product::where('id',$variation->product_id)->first();
            $term = ProductVariationTerm::select('product_variation_term.*','core_terms.name AS term_name','core_attrs.name AS attr_name','core_attrs.slug AS attr_slug')
                    ->join('core_terms','product_variation_term.term_id','=','core_terms.id')
                    ->join('core_attrs','core_terms.attr_id','=','core_attrs.id')
                    ->where('product_variation_term.variation_id',$variation_id)->get();
            $product_name = $product->title;
            $options = [];
            if (!empty($term)){
                $product_name .= ' - ';
                foreach ($term as $key => $item){
                    $product_name .= "$item->term_name, ";
                    $options[$item->attr_slug] = $item->term_name;
                }
            }
            $options['variation_id'] = $variation_id;

            if ($product){
                $get_stock = function ($st, $pr){
                    $sold = (!empty($pr->sold)) ? $pr->sold : 0;
                    if ($pr->stock_status == 'in' && $pr->is_manage_stock() == 1){
                        $st = $pr->quantity - $sold;
                    }
                    return $st;
                };
                if (Cart::count() > 0){
                    foreach (Cart::content() as $row){
                        if ($row->options->variation_id == $variation_id){
                            $stock = $get_stock($stock,$variation);
                            if ($row->qty + $request->input('qty') > $stock){
                                $add = 1;
                            }
                        }
                    }
                    if ($stock <= 0){$add = 0;}
                } else {
                    $stock = $get_stock($stock,$variation);
                    if ($request->input('qty') > $stock){
                        $add = 1;
                    }
                    if ($stock <= 0){$add = 0;}
                }
                if ($add == 0) {
                    $product_variation = [
                        'id'    =>  $product->id,
                        'name'  =>  (!empty($term)) ? substr($product_name,0,-2) : $product_name,
                        'qty'   =>  $quantity,
                        'price' =>  $variation->price,
                        'options'=> (count($options) > 0) ? $options : null,
                    ];
                    Cart::add($product_variation)->associate(Product::class);
                }
            }
        }

        $buy_now = $request->input('buy_now');
        if ($add == 0){
            $message = __('":title" has been added to your cart.',['title'=>(!empty($term)) ? substr($product_name,0,-2) : $product_name]);
        } else {
            $message = __('Product ":title" has been out of stock.',['title'=>(!empty($term)) ? substr($product_name,0,-2) : $product_name]);
        }

        return $this->sendSuccess([
            'status'   => ($add == 0) ? 1 : 0,
            'fragments'=>get_cart_fragments(),
            'url'=>$buy_now ? route('booking.checkout') : ''
        ],$message);
    }

    public function getStockStatus(){
        $stock = ''; $in_stock = true;
        if ($this->is_manage_stock()){
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
            if ($this->is_manage_stock()){
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
            'is_manage_stock' => $parent_manage == false ? $this->is_manage_stock() : 0,
            'stock'           => $this->getStockStatus(),
        ];
    }

}
