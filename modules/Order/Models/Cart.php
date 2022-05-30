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
                    $res[] = json_decode($item,true);
              }
              return $res;
          }
        );
    }

    public function addItem(CartItem $item){
        $this->items()->save($item);
        $this->syncTotal();
        $this->save();
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

        $order = $this;

        $shipping_country = $request->input($request->input('shipping_same_address') ? 'billing_country' : 'shipping_country');
        // CartManager add shipping
        if($res = CartManager::addShipping( $shipping_country ,$request->input("shipping_method_id"))){
            if($res['status'] == 0){
                throw new \Exception($res['message'] ?? __("Can not add shipping"));
            }
        }

        CartManager::addTax($request->input('billing_country') , $request->input('shipping_country'));

        $order->customer_id = auth()->id();
        $order->status = Order::DRAFT;
        $order->locale = app()->getLocale();
        $order->shipping_amount = $this->shipping_amount;
        $order->discount_amount = $this->discountTotal();
        $order->gateway = $request->input('payment_gateway');
        $order->save();

        /**
         * @var CartItem[] $items;
         */
        $items = $order->items;
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
        $order->syncTotal();

        //Tax
        if(!empty( $taxItems = $order->tax )){
            $tax_rate = 0;
            foreach ( $taxItems as $item ){
                $tax_rate += $item['tax_rate'];
            }
            $total_amount = $order->total;
            $tax_amount = ( $total_amount / 100 ) * $tax_rate;
            if(setting_item("prices_include_tax", 'yes') == "no"){
                $total_amount += $tax_amount;
            }
            $order->total = $total_amount;
            $order->tax_amount = $tax_amount;
            $order->addMeta('prices_include_tax',setting_item("prices_include_tax", 'yes'));
        }

        $coupons = $this->getJsonMeta('coupons');

        if(!empty($coupons) and count($coupons)>0){
            foreach ($coupons as $coupon){
                $couponOrder = new CouponOrder();
                $couponOrder->order_id = $order->id;
                $couponOrder->order_status = Order::DRAFT;
                $couponOrder->coupon_code = $coupon['code'];
                $couponOrder->coupon_amount = $coupon['amount'];
                $couponOrder->coupon_discount_type = $coupon['discount_type'];
                $couponOrder->coupon_data = $coupon;
                $couponOrder->save();
            }
        }

        $order->save();

        return $order;
    }
}
