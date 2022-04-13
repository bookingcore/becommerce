<?php

namespace Modules\Api\Controllers;
use App\Http\Controllers\Controller;


class AppController extends Controller
{
    public function getConfig(){
        $languages = \Modules\Language\Models\Language::getActive();
        $res = [
            'languages'=>$languages->map(function($lang){
                return $lang->only(['locale','name']);
            }),
        ];
        return $this->sendSuccess($languages);
    }

}
