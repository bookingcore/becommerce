<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Core\Models\Attribute;
use Modules\Product\Resources\AttributeResource;

class AttributeController extends ApiController
{

    public function index(){
        return AttributeResource::collection(Attribute::query()->where('service','product')->isActive()->paginate(30),['terms']);
    }
}
