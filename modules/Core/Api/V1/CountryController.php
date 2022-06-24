<?php


namespace Modules\Core\Api\V1;


use App\Http\Controllers\ApiController;

class CountryController extends ApiController
{

    public function index(){
        return [
            'data'=>get_country_lists(),
            'status'=>1
        ];
    }
}
