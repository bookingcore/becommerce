<?php


namespace Modules\Order\Models;


use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    public $incrementing = false;

    protected $attributes = [
        'id',
        'coupons',
        'total_discount',
        'shipping_amount',
        'shipping_method',
        'tax'
    ];

    protected $casts = [
        'coupons'=>AsCollection::class,
        'shipping_amount'=>'float',
        'shipping_method'=>'array',
        'tax'=>'array',
    ];

    public function items(){
        return $this->hasMany(CartItem::class);
    }
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

    public function getTotalAttribute(){
        $subTotal = $this->subtotal();
        $discount = $this->discountTotal();
        $shipping = $this->shippingTotal();
        $total = $subTotal + $shipping - $discount;

        return max(0,$total);
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
}
