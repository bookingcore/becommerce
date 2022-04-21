<?php


namespace Modules\Core\Api\V1;


use App\Http\Controllers\ApiController;
use Modules\Template\Models\Template;
use Modules\Theme\ThemeManager;

class AppController extends ApiController
{

    public function configs(){
        $languages = \Modules\Language\Models\Language::getActive();
        $actives = \App\Currency::getActiveCurrency();
        $current_theme = ThemeManager::current();
        $res = [
            'currency' => $actives,
            'main_currency' => setting_item('currency_main'),
            'languages'=>$languages->map(function($lang){
                return $lang->only(['locale','name']);
            }),
            'current_theme' => $current_theme,
        ];

        return $this->sendSuccess($res);
    }
    public function layout(){
        $res = [];
        $template = Template::find(setting_item('api_app_layout'));
        if(!empty($template)){
            $translate = $template->translateOrOrigin(app()->getLocale());
            $res = $translate->getProcessedContentAPI();
        }

        return $this->sendSuccess([
            'data'=>$res
        ]);
    }
}
