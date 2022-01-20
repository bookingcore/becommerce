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
use Modules\Core\Models\Attributes;
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
            'rows'               => $list,
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
            'rows'               => $list,
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

    public function attrs($row){
        return Attributes::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get();
    }

    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->where("status", "publish")->first();
        if(empty($row) or (!empty($row) and $row->status != 'publish' and  Auth::id() != $row->create_user)){
            abort(404);
            return;
        }
        //$this->recently_viewed($row->id);
        $product_variations = $row->variations;
        $translation = $row->translate(app()->getLocale());
        $review_list = Review::where('object_id', $row->id)->where('object_model', 'product')->where("status", "approved")->orderBy("id", "desc")->with('author')->paginate(setting_item('product_review_number_per_page', 5));
        $cats = $row->categories;
        $breadcrumbs = [
            [
                'name'=> __("Shop"),
                'url'=>route('product.index')
            ],
        ];
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
            'row'          => $row,
            'translation'  => $translation,
            'review_list'  => $review_list,
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'=>'is_single full_width style_default',
            'show_breadcrumb' => 0,
            'breadcrumbs'=> $breadcrumbs,
            'product_variations'    =>  $product_variations,
            'is_preview_mode'=>$is_preview_mode,
            'products_related' => $products_related
        ];
        $this->setActiveMenu($row);
        return view('product-detail', $data);
    }

    //tomorow fix
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

        // truyền ID
        $product_id = $request->post('id');
        // Kiểm tra xem có trong ss hay chưa
        $compare = (!empty(session('compare'))) ? session('compare') : [];
        if ($compare){
            foreach ($compare as $item){
                if ($item['id'] == $product_id){
                    return $this->sendSuccess([
                        'status'   => 1,
                    ]);
                }
            }
        }

        // Kiểm tra product
        $product = Product::find($request->post('id'));
        if(empty($product)){
            return $this->sendError(__("Service not found!"));
        }
        // Lấy data product

        $productArray = $product->getAttributes();
        $productArray['display_price'] = $product->display_price;
        $productArray['display_sale_price'] = $product->display_sale_price;
        //$product['attrs'] = $attrs;
        $product['brand_name']  = $product->brand->name ?? '';
        array_push($compare, $productArray);
        session(['compare' => $compare]);
        // lấy view
        $data = [
            'compare'   =>  session('compare'),
        ];
        return $this->sendSuccess([
            'status'   => 1,
            'count' =>  count($compare),
            'view'  =>  view('product.compare.list', $data)->render()
        ]);



        /*$v_price = ($product->product_type == 'variable') ? [] : [];
        $compare = (!empty(session('compare'))) ? session('compare') : [];
        $attrs = [];
        $brand = ProductBrand::select('name')->where('id',$product->brand_id)->first();
        if (!empty($product) && $product->product_type == 'variable'){
            foreach ($product->attributes_for_variation as $attr){
                $term_id = [];
                $product_variable = ProductVariationTerm::select('product_variation_term.*','core_terms.name','core_terms.attr_id')->join('core_terms','product_variation_term.term_id','=','core_terms.id')->where('product_id',$product->id)->get();
                if (!empty($product_variable)){
                    foreach ($product_variable as $item){
                        if ($attr == $item->attr_id){
                            array_push($term_id, [
                                'id'    =>  $item->term_id,
                                'name'  =>  $item->name
                            ]);
                        }
                    }
                }
                array_push($attrs,[
                    'id'    =>  $attr,
                    'term_id'=> array_unique($term_id,SORT_REGULAR)
                ]);
            }
        }
        $error = false;
        if ($compare){
            foreach ($compare as $item){
                if ($item['id'] == $product->id){
                    $error = true;
                }
            }
        }
        if ($error == false){
            $product = $product->getAttributes();
            $product['v_price'] = $v_price;
            $product['attrs'] = $attrs;
            $product['brand_name']  = $brand->name;

            array_push($compare, $product);
            session(['compare' => $compare]);
        }
        $data = [
            'compare'   =>  session('compare'),
        ];
        return [
            'count' =>  count($compare),
            'view'  =>  view('Product::frontend.layouts.compare', $data)->render()
        ];*/
    }

    public function remove_compare(Request $request){
        $compare = session('compare');
        $n_compare = [];
        $listAttr = Attributes::all();
        if (!empty($compare)){
            foreach ($compare as $row){
                if ($row['id'] == $request->post('id')){
                    continue;
                }
                array_push($n_compare, $row);
            }
        }
        session(['compare' => $n_compare]);
        $data = [
            'compare'   =>  session('compare'),
            'attributes'=>  $listAttr,
        ];
        return [
            'count' =>  count($n_compare),
            'view'  =>  view('Product::frontend.layouts.compare', $data)->render()
        ];
    }

    public function recent_viewed(){
        $products = '';
        if (!empty($recently = session('product_recently'))){
            $products = Product::whereIn('id',$recently)->limit(20)->get();
        }
        $data = [
            'page_title'         =>  __('Your Recently Viewed'),
            'rows'   =>  $products,
            'breadcrumbs'   =>  [
                [
                    'url'=>'',
                    'name'=> __('Your Recently Viewed')
                ]
            ]
        ];
        return view('Product::frontend.your-recent-viewed',$data);
    }

}
