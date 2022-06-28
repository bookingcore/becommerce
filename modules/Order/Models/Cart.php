<?php


namespace Modules\Order\Models;


use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Coupon\Models\CouponOrder;
use Modules\Order\Helpers\CartManager;

class Cart extends Order
{

    public static function findByCode($code){
        return parent::whereCode($code)->first();
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
        return $this->discount_amount;
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
              $meta =  $this->getMeta('tax',true,true);
              foreach ($meta as $item){
                    $res[] = json_decode($item->val,true);
              }
              return collect($res);
          }
        );
    }

    public function addItem(CartItem $item){
        $this->items()->save($item);
        $this->syncTotal();
        $this->save();
        $this->load('items');
        return true;
    }


    /**
     * Cart to Order
     * @param Request $request
     *
     * @return Order
     * @throws \Exception
     */
    public function prepareCheckout(Request $request){

        $shipping_country = $request->input($request->input('shipping_same_address') ? 'billing_country' : 'shipping_country');
        // CartManager add shipping
        if($res = $this->addShipping( $shipping_country ,$request->input("shipping_method_id"))){
            if($res['status'] == 0){
                throw new \Exception($res['message'] ?? __("Can not add shipping"));
            }
        }

        $this->addTax($request->input('billing_country') , $request->input('shipping_country'));

        $this->customer_id = auth()->id();
        $this->locale = app()->getLocale();
        $this->discount_amount = $this->discountTotal();
        $this->gateway = $request->input('payment_gateway');

        /**
         * @var CartItem[] $items;
         */
        $items = $this->items;
        foreach ($items as $order_item){
            $model = $order_item->model;
            if(!$model){
                $order_item->delete();
                throw new \Exception(__("Product: :id does not exists",['id'=>$order_item->object_id]));
            }
            $order_item->price = $model->sale_price;
            $order_item->locale = app()->getLocale();
            $order_item->calculateTotal();
            $order_item->calculateCommission();
            $order_item->save();
        }

        $this->syncTotal();

        //Tax
        if(!empty( $taxItems = $this->tax )){

            $tax_rate = $taxItems->sum('tax_rate');

            $total_amount = $this->total;
            $tax_amount = ( $total_amount / 100 ) * $tax_rate;
            if(setting_item("prices_include_tax", 'yes') == "no"){
                $total_amount += $tax_amount;
            }
            $this->total = $total_amount;
            $this->tax_amount = $tax_amount;
            $this->addMeta('prices_include_tax',setting_item("prices_include_tax", 'yes'));
        }

        $setting_expired_at = setting_item('product_hold_stock',60);
        if($setting_expired_at){
            $this->expired_at = date('Y-m-d H:i:s',time() + $setting_expired_at * MINUTE_IN_SECONDS);
        }

        $this->save();

        return $this;
    }

    public function items()
    {
        return $this->hasMany(CartItem::class,'order_id');
    }
}
