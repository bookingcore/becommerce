<?php


namespace Themes\Base\Controllers;


use Modules\Product\Models\Product;

class ProductController extends FrontendController
{

    public function index(){
        $query = Product::query();
        $query->with(['categories']);

        $data = [
            'page_title'=>__("Product"),
            'rows'=> $query->paginate(20)
        ];
        return view('product',$data);
    }
}
