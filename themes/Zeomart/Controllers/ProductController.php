<?php
namespace Themes\Zeomart\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * @var Product
     */
    protected $product;
    public function __construct()
    {
        $this->product = Product::class;
    }
    public function index(Request $request)
    {
        if($request->query('cat_slug')){
            $data = $request->query();
            $data['slug'] = $data['cat_slug'];
            unset($data['cat_slug']);
            return redirect()->to(route('product.category.index',$data));
        }
        $list = $this->product::search($request->input());

        $data = [
            'rows'               => $list->paginate(setting_item('product_per_page',12)),
            "blank"              => 1,
            'show_breadcrumb'    => 0,
            'breadcrumbs'=>[
                [
                    'name'=> (!empty($search)) ? 'Search Result For: "'.$search.'"' : 'Shop',
                ]
            ],

            'body_class'        => 'full_width',
            "seo_meta"           => Product::getSeoMetaForPageList()
        ];
        $data['layout'] = $request->query('layout',setting_item('zm_search_layout',1));
        $data['listing_list_style'] = request()->query('list_style',setting_item('zm_search_item_layout'));

        return view('product', $data);
    }
}
