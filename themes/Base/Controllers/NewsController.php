<?php

namespace Themes\Base\Controllers;

use Illuminate\Http\Request;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;

class NewsController extends FrontendController
{
    public function index(Request $request){
        $s = $request->query('s');
        $model_News = News::search([
            's'=>$request->query('s')
        ]);
        $data = [
            'rows'=>$model_News->groupBy('core_news.id')->with(['cat','cat.translation','translation'])->paginate(12),
            "seo_meta" => News::getSeoMetaForPageList(),
            'page_title'=>$s ? __('Search result for ":key"',['key'=>$s]) : false,
            'header_title'=>$s ? __('Search result for ":key"',['key'=>$s]) : setting_item_with_lang('news_page_list_title',false,__("News"))
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
            'rows'=>$model_News->with(['cat','cat.translation','translation'])->paginate(12),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => route('news')],
                ['name' => $translation->name,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList(),
            'translation'=>$translation,
            'header_title'=>$translation->name,
            'current_cat'=>$category,
            'page_title'=>$translation->name,
        ];
        return view('news',$data);
    }



    public function tag(Request $request,$slug){
        $tag = Tag::query()->where('slug',$slug)->first();
        if(!$tag){
            abort(404);
        }

        $model_News = News::search([
            's'=>$request->query('s'),
            'tag_id'=>$tag->id
        ]);
        $translation = $tag->translate();
        $data = [
            'rows'=>$model_News->with(['cat','cat.translation','translation'])->paginate(12),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => route('news')],
                ['name' => $translation->name,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList(),
            'translation'=>$translation,
            'page_title'=>$translation->name,
            'header_title'=>$translation->name,
        ];
        return view('news',$data);
    }

    public function detail(Request $request,$slug){
        $news = News::query()->isActive()->where('slug',$slug)->with(['tags','tags.translation'])->first();
        $related_post = $news->where('cat_id',$news->cat_id)->where('slug','!=',$slug)->get();
        if(!$news){
            abort(404);
        }
        $translation = $news->translate();
        $data = [
            'row'=>$news,
            "seo_meta" => $news->me,
            'translation'=>$translation,
            'page_title'=>$translation->title,
            'header_title'=>$translation->title,
            'related_post' => $related_post
        ];
        return view('news-detail',$data);
    }

}
