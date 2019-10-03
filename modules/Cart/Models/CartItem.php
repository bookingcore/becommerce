<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/3/2019
 * Time: 5:23 PM
 */

namespace Modules\Cart\Models;

use App\BaseModel;

class CartItem extends BaseModel
{
    protected $table = 'core_cart_items';

    public function product()
    {
        return $this->morphTo();
    }

    /**
     * @inheritDoc
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * @inheritDoc
     */
    public function total()
    {
        return $this->price * $this->quantity;
    }
    /**
     * Property accessor alias to the total() method
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->total();
    }

    public function scopeOfCart($query, $cart)
    {
        $cartId = is_object($cart) ? $cart->id : $cart;
        return $query->where('cart_id', $cartId);
    }

    public function scopeByProduct($query, $product)
    {
        return $query->where([
            ['product_id', '=', $product->id],
            ['product_type', '=', $product->product_type]
        ]);
    }
}