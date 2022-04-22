<?php


namespace Modules\Product\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Resources\BrandResource;

class BrandController extends ApiController
{

    public function index(){
        return BrandResource::collection(ProductBrand::query()->isActive()->paginate(30));
    }

}
