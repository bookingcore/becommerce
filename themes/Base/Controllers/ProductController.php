<?php
namespace Themes\Base\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\News\Models\Tag;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttr;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Models\ProductVariationTerm;
use Illuminate\Http\Request;
use Modules\Review\Models\Review;
use Modules\Core\Models\Attribute;
use Modules\User\Models\User;

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
            'product_min_max_price' => Product::getMinMaxPrice(),
            "blank"              => 1,
            'categories'         => ProductCategory::getAll(),
            'show_breadcrumb'    => 0,
            'breadcrumbs'=>[
                [
                    'name'=> (!empty($search)) ? 'Search Result For: "'.$search.'"' : 'Shop',
                ]
            ],
            'body_class'        => 'full_width',
            "seo_meta"           => Product::getSeoMetaForPageList()
        ];

        $data['attributes'] = ProductAttr::search()->with('terms.translation')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();

        return view('product', $data);
    }

    public function categoryIndex( $slug , Request $request){
        $category = ProductCategory::where('slug',$slug)->first();

        if(!$category){
            abort(404);
        }
        $translation = $category->translate();

        $param = $request->input();
        $param['category_id'] = $category->id;
        $list = $this->product::search($param);

        $data = [
            'rows'               => $list->paginate(setting_item('product_per_page',12)),
            'product_min_max_price' => Product::getMinMaxPrice(),
            "blank"              => 1,
            'categories'         => ProductCategory::getAll(),
            'show_breadcrumb'    => 0,
            'breadcrumbs'=>[
                [
                    'name'=> __("Shop"),
                    'url'=>route('product.index')
                ],
                [
                    'name'=> $category->name,
                ]
            ],
            'body_class'        => 'full_width',
            "seo_meta"           => $category->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'current_cat'=>$category,
            'translation'=>$translation
        ];

        $data['attributes'] = ProductAttr::search()->with('terms.translation')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();
        return view('product', $data);
    }

    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->first();
        if(empty($row) or (!empty($row) and $row->status != 'publish' and  Auth::id() != $row->create_user)){
            abort(404);
            return;
        }

        $product_variations = $row->variations;
        $translation = $row->translate(app()->getLocale());
        $review_list = Review::where('object_id', $row->id)->where('object_model', 'product')->where("status", "approved")->orderBy("id", "desc")->with('author')->paginate(setting_item('product_review_number_per_page', 5));
        $breadcrumbs = [
            [
                'name'=> __("Shop"),
                'url'=>route('product.index')
            ],
        ];
        $cats = $row->categories;
        if ($cats->count()){
            $breadcrumbs[] = [
                    'name' => $cats[0]->name,
                    'url'  => route('product.category.index', ['slug'=>$cats[0]->slug])
                ];
        }
        $breadcrumbs[] = [
            'class'=>'active',
            'name'=>$translation->title
        ];
        $is_preview_mode = false;
        if($row->status != 'publish'){
            $is_preview_mode = true;
            $row->title = '[Preview mode] '.$row->title;
            $translation->title = '[Preview mode] '.$translation->title;
        }
        $products_related = $this->product::join(ProductCategoryRelation::getTableName().' as cats_relations','cats_relations.target_id','=','products.id')
            ->where('products.status','publish')
            ->where('products.id','!=',$row->id)
            ->whereIn('cats_relations.cat_id',$cats->pluck('id'))->get();
        $data = [
            'row'                => $row,
            'translation'        => $translation,
            'review_list'        => $review_list,
            'seo_meta'           => $row->getSeoMetaWithTranslation(app()->getLocale(), $translation),
            'body_class'         => 'is_single',
            'show_breadcrumb'    => 0,
            'breadcrumbs'        => $breadcrumbs,
            'product_variations' => $product_variations,
            'is_preview_mode'    => $is_preview_mode,
            'products_related'   => $products_related
        ];
        $this->setActiveMenu($row);
        return view('product-detail', $data);
    }

    public function quick_view(Request $request){
        $id = (!empty($request->id)) ? $request->id : '';
        $product = Product::where('id',$id)->first();
        $translation = $product->translateOrOrigin(app()->getLocale());
        $product_variations = $this->product_variations($product);

        $data = [
            'row'   =>  $product,
            'translation'  => $translation,
            'variations_product'    =>  json_encode($product_variations['variations_product']),
            'attrs_list' =>  $product_variations['attr_list']
        ];
        return view('Product::frontend.details.quick-view', $data)->render();
    }

    public function compare(Request $request){
        $product_id = $request->input('id');
        $compare = (!empty(session('compare'))) ? session('compare') : [];
        if ($compare) {
            foreach ($compare as $item) {
                if ($item['id'] == $product_id) {
                    return $this->sendSuccess([
                        'status' => 1,
                    ]);
                }
            }
        }
        array_push($compare, ['id' => $product_id]);
        session(['compare' => $compare]);
        $data = [
            'compare' => get_compare_details(),
        ];
        return $this->sendSuccess([
            'status'   => 1,
            'count' =>  count($compare),
            'view'  =>  view('product.compare.list', $data)->render()
        ]);
    }

    public function remove_compare(Request $request){
        $compare = session('compare');
        if (!empty($compare)){
            foreach ($compare as $key => $row){
                if ($row['id'] == $request->input('id')){
                    unset($compare[$key]);
                }
            }
        }
        session(['compare' => $compare]);
        $data = [
            'compare'   =>  session('compare'),
        ];
        return [
            'count' =>  count($compare),
            'view'  =>  view('product.compare.list', $data)->render()
        ];
    }
}
