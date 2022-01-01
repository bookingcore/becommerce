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
            "seo_meta" => News::getSeoMetaForPageList(),
            'page_title'=>__("News")
        ];
        return view('news',$data);
    }

    public function category(Request $request,$slug){
        $category = NewsCategory::query()->where('slug',$slug)->isActive()->first();
        if(!$category){
            abort(404);
        }

        $model_News = News::search([
            's'=>$request->query('s'),
            'category_id'=>$category->id
        ]);
        $translation = $category->translate();
        $data = [
            'rows'=>$model_News->with(['cat','cat.translation','translation'])->paginate(5),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news")],
                ['name' => $translation->name,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList(),
            'translation'=>$translation,
            'page_title'=>$translation->name,
            'header_title'=>$translation->name,
            'current_cat'=>$category
        ];
        return view('news',$data);
    }
}
