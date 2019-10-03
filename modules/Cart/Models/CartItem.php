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

    protected $fillable = [
        'product_type',
        'product_id'
    ];
    public function product()
    {
        $types = get_product_types();
        if(!array_key_exists($this->product_type,$types)) return false;
        return $this->hasOne($types[$this->product_type],'id','product_id');
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

    public function getPriceHtmlAttribute(){
        return format_money($this->price);
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