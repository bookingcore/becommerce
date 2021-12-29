<?php


namespace Modules\Product\Api;


use Modules\FrontendController;
use Modules\Product\Models\Product;
use Modules\Product\Resources\ProductResource;

class ProductController extends FrontendController
{

    public function index(){

        $query = Product::query();

        return ProductResource::collection($query->paginate(24));
    }
}
