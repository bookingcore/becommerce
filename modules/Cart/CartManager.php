<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/3/2019
 * Time: 5:00 PM
 */

class CartManager
{
    const CONFIG_SESSION_KEY = 'becommerce_cart_mamager';

    /** @var string The key in session that holds the cart id */
    protected $sessionKey;

    /** @var  Cart  The Cart model instance */
    protected $cart;

    public function __construct()
    {
        $this->sessionKey = self::CONFIG_SESSION_KEY;
    }

    /**
     * @inheritDoc
     */
    public function getItems()
    {
        return $this->exists() ? $this->model()->getItems() : collect();
    }

    public function addItem($product, $qty = 1, $params = [])
    {
        $cart = $this->findOrCreateCart();

        return $cart->addItem($product, $qty, $params);
    }

    public function exists()
    {
        return (bool) $this->getCartId();
    }

    protected function getCartId()
    {
        return session($this->sessionKey);
    }

    protected function findOrCreateCart()
    {
        return $this->model() ?: $this->createCart();
    }

    public function model()
    {
        $id = $this->getCartId();

        if ($id && $this->cart) {
            return $this->cart;
        } elseif ($id) {
            $this->cart = Modules\Cart\Models\Cart::find($id);
            return $this->cart;
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        if ($cart = $this->model()) {
            $cart->clear();
        }
    }

    /**
     * @inheritDoc
     */
    public function itemCount()
    {
        return $this->exists() ? $this->model()->itemCount() : 0;
    }
    /**
     * @inheritDoc
     */
    public function total()
    {
        return $this->exists() ? $this->model()->total() : 0;
    }

    /**
     * Creates a new cart model and saves it's id in the session
     */
    protected function createCart()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $attributes = [
                'user_id' => \Illuminate\Support\Facades\Auth::user()->id
            ];
        }
        return $this->setCartModel(Modules\Cart\Models\Cart::create($attributes ?? []));
    }

    protected function setCartModel($cart)
    {
        $this->cart = $cart;
        session([$this->sessionKey => $this->cart->id]);
        return $this->cart;
    }

    /**
     * @inheritDoc
     */
    public function forget()
    {
        $this->cart = null;
        session()->forget($this->sessionKey);
    }

    /**
     * @inheritDoc
     */
    public function getUser()
    {
        return $this->exists() ? $this->model()->getUser() : null;
    }
    /**
     * @inheritDoc
     */
    public function setUser($user)
    {
        if ($this->exists()) {
            $this->cart->setUser($user);
            $this->cart->save();
            $this->cart->load('user');
        }
    }
    /**
     * @inheritdoc
     */
    public function removeUser()
    {
        $this->setUser(null);
    }
}