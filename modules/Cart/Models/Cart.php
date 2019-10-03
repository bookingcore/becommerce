<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/3/2019
 * Time: 5:18 PM
 */
namespace Modules\Cart\Models;

use App\BaseModel;
use Illuminate\Contracts\Auth\Authenticatable;

class Cart extends BaseModel
{
    protected $table = 'core_carts';

    const ACTIVE     = 'active';
    const CHECKOUT   = 'checkout';
    const COMPLETED  = 'completed';
    const ABANDONDED = 'abandoned';

    const EXTRA_PRODUCT_MERGE_ATTRIBUTES_CONFIG_KEY = 'beecommerce_extra_product_attributes';

    protected $fillable = [
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
    /**
     * @inheritDoc
     */
    public function getItems()
    {
        return $this->items;
    }
    /**
     * @inheritDoc
     */
    public function itemCount()
    {
        return $this->items->sum('quantity');
    }
    /**
     * @inheritDoc
     */
    public function addItem($product, $qty = 1, $params = [])
    {
        $item = $this->items()->ofCart($this)->byProduct($product)->first();
        if ($item) {
            $item->quantity += $qty;
            $item->save();
        } else {
            $item = $this->items()->create(
                array_merge(
                    $this->getDefaultCartItemAttributes($product, $qty),
                    $params['attributes'] ?? []
                )
            );
        }
        $this->load('items');
        return $item;
    }
    /**
     * @inheritDoc
     */
    public function removeItem($item)
    {
        if ($item) {
            $item->delete();
        }
        $this->load('items');
    }
    /**
     * @inheritDoc
     */
    public function removeProduct($product)
    {
        $item = $this->items()->ofCart($this)->byProduct($product)->first();
        $this->removeItem($item);
    }
    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->items()->ofCart($this)->delete();
        $this->load('items');
    }
    /**
     * @inheritDoc
     */
    public function total()
    {
        return $this->items->sum('total');
    }
    /**
     * The cart's user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
    /**
     * @inheritDoc
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @inheritDoc
     */
    public function setUser($user)
    {
        if ($user instanceof Authenticatable) {
            $user = $user->id;
        }
        $this->user_id = $user;
    }
    public function scopeActives($query)
    {
        return $query->whereIn('state', self::ACTIVE);
    }
    public function scopeOfUser($query, $user)
    {
        return $query->where('user_id', is_object($user) ? $user->id : $user);
    }
    /**
     * Returns the default attributes of a Buyable for a cart item
     *
     * @param mixed $product
     * @param integer $qty
     *
     * @return array
     */
    protected function getDefaultCartItemAttributes($product, $qty)
    {
        return [
            'product_type' => $product->product_type,
            'product_id'   => $product->id,
            'quantity'     => $qty,
            'price'        => $product->price
        ];
    }
}