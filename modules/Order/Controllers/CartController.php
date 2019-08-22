<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/22/2019
 * Time: 4:31 PM
 */
namespace Modules\Order\Controllers;

use Modules\FrontendController;

class CartController extends FrontendController{

    public function index(){
        return view('Order::frontend.cart.index');
    }
}