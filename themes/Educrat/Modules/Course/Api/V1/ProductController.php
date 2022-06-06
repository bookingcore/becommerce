<?php


namespace Themes\Educrat\Modules\Course\Api\V1;


use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{

    public function filter(){
        return setting_item_array('ec_products_sidebar');
    }
}
