<?php

namespace Themes\Base\Controllers;

use Illuminate\Http\Request;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;

class NewsController extends FrontendController
{
    public function index(Request $request){
        $model_News = News::search([
            's'=>$request->query('s')
        ]);
        $data = [
            'rows'=>$model_News->with(['cat','cat.translation','translation'])->paginate(5),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news") ,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('news',$data);
    }
}
