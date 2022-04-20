<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Resources\ProductResource;

class ProductController extends ApiController
{

    public function index(Request $request){

        $query = Product::search([
            's'=>$request->query('s')
        ]);

        return ProductResource::collection($query->paginate(24));
    }
}
