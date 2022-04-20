<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Product\Resources\CategoryResource;

class CategoryController extends ApiController
{

    public function index(){
        return CategoryResource::collection(\Category::query()->isActive()->toTree());
    }
}
