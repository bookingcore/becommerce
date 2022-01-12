<?php

namespace Modules\Product\Models;

use App\BaseModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductVariation extends BaseProduct
{
    protected $table = 'products';
    public $type = 'product_variation';

    protected $fillable = [
        'title',
        'content',
        'short_desc',
        'status'
    ];

    protected $casts = [
        'dimensions'=>'array'
    ];

    public static function getModelName()
    {
        return __("ProductVariation");
    }

    public static function getTypeName()
    {
        return __("Variable Product");
    }

    public function variations(){
        return $this->hasMany(ProductVariation::class,'product_id')->orderBy('id','desc');
    }

    public function getDetailUrl($locale = false)
    {
        return route('product.detail',['slug'=>'sleeve-linen-blend-caro-pane-shirt']);
    }


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
                    if ($pr->stock_status == 'in' && $pr->is_manage_stock == 1){
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
        if ($this->is_manage_stock > 0){
            if ($this->stock_status == 'in'){
                $stock = __(':count in stock',['count'=>$this->quantity]);
            }
        } else {
            $stock = ($this->stock_status == 'in') ? __('In Stock') : '';
        }
        if ($this->stock_status == 'out'){
            $stock = __('Out Of Stock');
            $in_stock = false;
        }
        return [
            'stock'     =>  $stock,
            'in_stock'  =>  $in_stock
        ];
    }

    // ham nay de lay gia ban, vi deu dung chung field la price nen a ko can viet vao day, neu ko phai la price thi co the doi o day
//    public function getBuyablePrice($options = NULL){
//
//       return $this->custom_price_col;// ten cua col price
//    }
//
//    // tuogn tu neu ten san p ham ko phai la title thi co the custom bang cach overide function
//    public function getBuyableDescription($options = NULL){
//        return $this->ten_san_pham;
//    }

    // hieu chua, nhung do 2 bang do ten field giong nhau nen a ko can overide function, su dung lai dc
}
