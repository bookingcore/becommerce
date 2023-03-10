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
        $limit = min(100,$request->query('limit',24));
        $need = $request->query('needs',[]);
        return ProductResource::collection($query->paginate($limit),array_merge($need,[
            'price',
            'categories',
            'review_data',
            $request->query('search_type')
        ]));
    }

    public function detail(Request $request,$id){
        if(is_numeric($id)){
            $row = $this->product::find($id);
        }else{
            $row = $this->product::query()->whereSlug($id)->first();
        }
        if(!$row or $row->status != 'publish'){
            abort(404);
            return;
        }
        return new ProductResource($row,[
            'content',
            'variations',
            'review_data',
            'categories',
            'tags',
            'author',
            'gallery'
        ]);
    }

    public function related(Request $request,$id){
        $row = $this->product::find($id);
        if(!$row or $row->status != 'publish'){
            abort(404);
            return;
        }
        return ProductResource::collection($row->related()->paginate(12),[
            'price',
            'categories',
            'review_data'
        ]);
    }
}
