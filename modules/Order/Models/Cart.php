<?php


namespace Modules\Order\Models;


use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Order
{

    protected $attributes = [
        'shipping_method',
        'tax'
    ];


    public function fromData($data){
        if(empty($data) or empty($data['items'])){
            $this->setRelation("items",collect([]));
        }
        foreach ($data as $k=>$value){
            switch ($k){
                case "items":
                    if(is_array($value)){
                        $items = collect();
                        foreach ($value as $v2){
                            $items->push(CartItem::fromArray($v2));
                        }
                        $this->setRelation("items",$items);
                    }
                    break;
                default:
                    $this->setAttribute($k,$value);
                    break;
            }
        }
    }

    public function total(): Attribute
    {
       return Attribute::make(
           get:function($value){
               $subTotal = $this->subtotal();
               $discount = $this->discountTotal();
               $shipping = $this->shippingTotal();
               $total = $subTotal + $shipping - $discount;

               return max(0,$total);
           }
       );
    }

    /**
     * Get Subtotal
     *
     * @return float
     */
    public function subtotal(){
        return $this->items->sum('subtotal');
    }

    public function discountTotal(){
        return $this->total_discount;
    }

    public function shippingTotal(){
        return $this->items->sum('shipping_amount') + $this->shipping_amount;
    }

    /**
     * Create draft cart
     *
     * @return Cart
     */
    public static function createDraft(){
        $cart = new self();
        $cart->customer_id = auth()->id();
        $cart->status = Order::DRAFT;
        $cart->locale = app()->getLocale();
        $cart->save();

        return $cart;
    }

    public function tax() : Attribute
    {
        return Attribute::make(
          get:function($value){
              $res = [];
              $meta =  $this->getMeta('tax',true);
              foreach ($meta as $item){
                    $res[] = json_decode($item,true);
              }
              return $res;
          }
        );
    }
}
