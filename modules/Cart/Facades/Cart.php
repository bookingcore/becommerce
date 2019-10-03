<?php
namespace Modules\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection getItems()
 * @method static itemCount()
 */
class Cart extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'becommerce.cart';
    }
}