<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Modules\Core\Models\Attribute;
use Modules\Product\Models\ProductAttr;
use Modules\Product\Resources\AttributeResource;

class AttributeController extends ApiController
{

    public function index(){
        return AttributeResource::collection(Attribute::query()->where('service','product')->isActive()->paginate(30),['terms']);
    }

    public function terms(Request $request,ProductAttr $attribute){
        $query = $attribute->terms();
        $needs = $request->query('needs',[]);
        if(in_array('count',$needs))
        {
            $query->withCount('products');
        }
        return \Modules\Product\Resources\TermResource::collection($query->paginate(100),$needs);
    }
}
