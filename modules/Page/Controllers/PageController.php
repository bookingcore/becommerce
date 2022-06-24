<?php
namespace Modules\Page\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Modules\AdminController;
use Modules\Page\Models\Page;
use Modules\Page\Models\PageTranslation;

class PageController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = [
            'rows' => Page::paginate(20)
        ];
        return view('Page::frontend.index', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail()
    {
        /**
         * @var Page $page
         * @var PageTranslation $translation
         */

        $slug = request()->route('slug');

        $page = Page::where('slug', $slug)->first();

        if (empty($page) || !$page->is_published) {
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
                ['name' => $page->title,'class' => 'active'],
            ],
        ];
        return view('Page::frontend.detail', $data);
    }
}
