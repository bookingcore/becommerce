<?php

namespace Modules\Api\Controllers;
use App\Http\Controllers\Controller;


class AppController extends Controller
{
    public function getConfig(){
        $languages = \Modules\Language\Models\Language::getActive();
        $categories = \Modules\Product\Models\ProductCategory::getAll();
        $actives = \App\Currency::getActiveCurrency();
        $current = \App\Currency::getCurrent('currency_main');
        $res = [
            'currency' => $actives,
            'current_currency' => $current,
            'languages'=>$languages->map(function($lang){
                return $lang->only(['locale','name']);
            }),
            'categories' => $categories
        ];
        return $this->sendSuccess($res);
    }

}
