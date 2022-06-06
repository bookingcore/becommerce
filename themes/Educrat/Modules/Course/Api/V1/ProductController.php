<?php


namespace Themes\Educrat\Modules\Course\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Product\Models\ProductAttr;
use Modules\Product\Resources\AttributeResource;

class ProductController extends ApiController
{

    public function filter(){
        $items = collect(setting_item_array('ec_products_sidebar'));

        $attrs = ProductAttr::search($items->where('type','attr')->pluck('attr')->all())->get();

        return AttributeResource::collection($attrs);
    }
}
