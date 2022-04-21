<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Resources\ProductResource;

class ProductController extends ApiController
{

    public $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request){

        $query = Product::search($request->query());

        return ProductResource::collection($query->paginate(24));
    }

    public function detail(Request $request,$id){
        $row = $this->product::find($id);
        if(!$row or $row->status != 'publish'){
            abort(404);
            return;
        }
        return new ProductResource($row,[
            'content',
            'variations',
            'review_data',
            'categories',
            'tags'
        ]);
    }
}
