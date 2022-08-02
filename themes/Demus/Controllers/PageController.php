<?php

namespace Themes\demus\Controllers;

use Modules\Page\Models\Page;
use Modules\Page\Models\PageTranslation;

class PageController extends FrontendController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($slug)
    {
        /**
         * @var Page $page
         * @var PageTranslation $translation
         */

        $page = Page::where('slug', $slug)->first();

        if (empty($page) || $page->status != 'publish') {
            abort(404);
        }
        $translation = $page->translate(app()->getLocale());
        $data = [
            'row' => $page,
            'p_style'   => $page->page_style,
            'c_background' => $page->c_background,
            'show_breadcrumb'   => $page->show_breadcrumb,
            'translation' => $translation,
            'seo_meta'  => $page->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'  => "page {$page->slug}",
            'breadcrumbs' => [
                ['name' => $translation->title,'class' => 'active'],
            ],
        ];
        return view('page', $data);
    }
}
