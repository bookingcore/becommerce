<?php


namespace Themes\Base\Controllers;


use Modules\Page\Models\Page;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\News\Models\News;

class HomeController extends FrontendController
{
    public function index(){
        $home_page_id = setting_item('home_page_id');
        if($home_page_id && $page = Page::where("id",$home_page_id)->where("status","publish")->first())
        {
            $this->setActiveMenu($page);
            $seo_meta = $page->getSeoMeta();
            $seo_meta['full_url'] = url("/");
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'p_style' => $page->page_style,
                'show_breadcrumb'  => $page->show_breadcrumb,
                'is_homepage'  => true,
                'compare'      => (session('compare')) ? session('compare') : '',
                'breadcrumbs' => [
                    ['name' => $page->title,'class' => 'active'],
                ],
            ];
            return view('index',$data);
        }
        return redirect(route('news'));
    }
}
