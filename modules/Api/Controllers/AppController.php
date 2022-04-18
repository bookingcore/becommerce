<?php

namespace Modules\Api\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Page\Models\Page;
use Modules\Template\Models\Template;
use Modules\Theme\ThemeManager;
use Modules\Media\Models\MediaFile;

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
        ];
        return $this->sendSuccess($res);
    }

    public function getHomeData(){
        $query = Template::query()->select('content')->where('id', '=', '2');
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        if(!empty($res) && isset($res[0]['content'])) {
            $res = json_decode($res[0]['content'], true);
            $mediafile = new MediaFile();
            foreach ($res as $key => $value) {
                if($value['type'] == 'banner_slider') {
                    if(isset($value['model']['sliders']) && !empty($value['model']['sliders'])){
                        $temp = [];
                        foreach ($value['model']['sliders'] as $v) {
                            //(new MediaFile())->findById($id);
                            $v['image'] = $mediafile->findById($v['image'])['file_path'];
                            array_push($temp, $v);
                        }
                        $value['model']['sliders'] = $temp;
                        $res[$key] = $value;
                    }
                }
                if($value['type'] == 'promotion') {
                    if(isset($value['model']['list_items']) && !empty($value['model']['list_items'])){
                        $temp = [];
                        foreach ($value['model']['list_items'] as $v) {
                            //(new MediaFile())->findById($id);
                            $v['image'] = $mediafile->findById($v['image'])['file_path'];
                            array_push($temp, $v);
                        }
                        $value['model']['list_items'] = $temp;
                        $res[$key] = $value;
                    }
                }
            }
        }

        return response()->json([
            'results' => $res
        ]);
    }

}
