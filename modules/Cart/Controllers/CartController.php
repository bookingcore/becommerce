<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/3/2019
 * Time: 5:34 PM
 */
namespace Modules\Cart\Controllers;

use Modules\FrontendController;
use Modules\Product\Models\Product;

class CartController extends FrontendController{

    public function add(\CartManager $cartManager){

        $product_id  = request()->input('product_id');
        if(empty($product_id)) $this->sendError(__("Product id is required"));

        $quantity  = request()->input('quantity');
        if(empty($quantity) or $quantity < 1) $this->sendError(__("Quantity is required"));

        $product = Product::find($product_id);
        if(empty($product)){
            $this->sendError(__("Product not found"));
        }

        $product_types = get_product_types();
        if(!array_key_exists($product->product_type,$product_types) or !class_exists($product_types[$product->product_type])) $this->sendError(__("Product type not found"));

        $product = new $product_types[$product->product_type] ($product->getAttributes());

        $product->addToCartValidate(request());

        $cartManager->addItem($product,$quantity,$product->cartExtraParams(request()));

        $this->sendSuccess();
    }
}