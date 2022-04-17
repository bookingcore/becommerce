<?php

namespace Modules\Api\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Page\Models\Page;
use Modules\Template\Models\Template;
use Modules\Theme\ThemeManager;


class AppController extends Controller
{
    public function getConfig(){
        $languages = \Modules\Language\Models\Language::getActive();
        $categories = \Modules\Product\Models\ProductCategory::getAll();
        $actives = \App\Currency::getActiveCurrency();
        $current = \App\Currency::getCurrent('currency_main');
        $current_theme = ThemeManager::current();
        $res = [
            'currency' => $actives,
            'current_currency' => $current,
            'languages'=>$languages->map(function($lang){
                return $lang->only(['locale','name']);
            }),
            'categories' => $categories,
            'current_theme' => $current_theme,
            'page' => $page
        ];

        return $this->sendSuccess($res);
    }

    public function getHomeData(Request $request){
        $q = $request->query('q');
        $query = Template::query()->select('id', 'title as text');
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

}
