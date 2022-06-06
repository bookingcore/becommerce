<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Resources\CategoryResource;

class CategoryController extends ApiController
{

    public function index(Request $request){
        $needs = $request->query('needs',[]);

        $query  = ProductCategory::query()->isActive();
        if(in_array('count',$needs)){
            $query->withCount('products');
        }
        return CategoryResource::collection($query->get()->toTree(),$needs);
    }
}
