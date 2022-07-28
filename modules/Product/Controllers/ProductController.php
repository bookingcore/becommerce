<?php
namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
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
        $list = $this->product::search($request->input());

        $categories = ProductCategory::where('status', 'publish')->with(['translations'])->limit(999)->get()->toTree();

        $data = [
            'rows'               => $list->paginate(setting_item('product_per_page',12)),
            'product_min_max_price' => Product::getMinMaxPrice(),
            "blank"              => 1,
            'categories'         => $categories,
            'show_breadcrumb'    => 0,
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'class'=>'active',
                    'name'=> (!empty($search)) ? 'Search Result For: "'.$search.'"' : 'Shop',
                ]
            ],
            'body_class'        => 'full_width',
            "seo_meta"           => Product::getSeoMetaForPageList()
        ];

        $data['attributes'] = Attribute::where('service', 'product')->with('terms.translations')->get();
        $data['brands']  = ProductBrand::with(['products','translations'])->get()->map(function ($item){
            $item->count_product  = count($item->products);
            return $item;
        });

        return view('Product::frontend.search', $data);
    }

    public function categoryIndex( $slug , Request $request){
        $getCats = ProductCategory::where('slug',$slug)->first();
        $param = $request->input();
        $param['cat_id'] = $getCats->id;
        $data = $this->product::search($param)->paginate(setting_item('product_per_page',12));
        return view('Product::frontend.categories', (isset($data)) ? $data : []);
    }

    public function attrs($row){
        return Attribute::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get();
    }

    public function product_variations($row){
        $attrs = (!empty($row->attributes_for_variation)) ? Attribute::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get() : null;
        $terms = ProductTerm::select('*','core_terms.attr_id as attr_id')->join('core_terms','product_term.term_id','=','core_terms.id')->where('target_id',$row->id)->get();
        $product_variations = ProductVariation::where('product_id',$row->id)->get();
        $get_variation = [];
        if (!empty($product_variations)){
            foreach ($product_variations as $item){
                $product_variations_term = ProductVariationTerm::where('variation_id',$item->id)->pluck('term_id')->toArray();
                sort($product_variations_term);
                array_push($get_variation, [
                    'variations'   =>  $item->getAttributes(),
                    'term_id'       =>  $product_variations_term
                ]);
            }
        }
        $attrs_list = [];
        if (!empty($attrs)){
            foreach ($attrs as $attr){
                $term_list = [];
                foreach ($terms as $term){
                    if ($attr->id == $term->attr_id){
                        array_push($term_list, $term->getAttributes());
                    }
                }
                array_push($attrs_list,[
                    'attr'      =>  [
                        'id'    =>  $attr->id,
                        'name'  =>  $attr->name,
                        'type'  =>  $attr->display_type
                    ],
                    'terms'     =>  $term_list
                ]);
            }
        }
        return [
            'attr_list' => $attrs_list,
            'variations_product' => $get_variation
        ];
    }

    public function recently_viewed($row){
        $p_recently = (!empty(session('product_recently'))) ? session('product_recently') : [];
        if (count($p_recently)){
            if (!in_array($row,$p_recently)){
                array_push($p_recently, $row);
                session(['product_recently'=>$p_recently]);
            } else {
                return false;
            }
        } else {
            $item[] = $row;
            session(['product_recently'=>$item]);
        }
    }

    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->where("status", "publish")->first();
        if(empty($row) or (!empty($row) and $row->status != 'publish' and  Auth::id() != $row->create_user)){
            abort(404);
            return;
        }
        $this->recently_viewed($row->id);
        $product_variations = $this->product_variations($row);
        $translation = $row->translate(app()->getLocale());
        $review_list = $row->review_list()->orderBy("id", "desc")->with('author')->paginate(setting_item('product_review_number_per_page', 5));
        $cats = $row->categories;
        $bc = [
            'url'=>'',
            'class'=>'active',
            'name'=>$translation->title
        ];
        if ($cats->count()){
            $c_breadcrumbs = [
                [
                    'name' => $cats[0]->name,
                    'url'  => route('product.category.index', ['slug'=>$cats[0]->slug])
                ],
                $bc
            ];
        } else {
            $c_breadcrumbs = [$bc];
        }
        $is_preview_mode = false;
        if($row->status != 'publish'){
            $is_preview_mode = true;
            $row->title = '[Preview mode] '.$row->title;
            $translation->title = '[Preview mode] '.$translation->title;
        }

        $data = [
            'row'          => $row,
            'translation'  => $translation,
            'booking_data' => $row->getBookingData(),
            'review_list'  => $review_list,
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'=>'is_single full_width style_default',
            'show_breadcrumb' => 0,
            'breadcrumbs'=> $c_breadcrumbs,
            'variations_product'    =>  json_encode($product_variations['variations_product']),
            'attrs_list' =>  $product_variations['attr_list'],
            'is_preview_mode'=>$is_preview_mode
        ];
        $this->setActiveMenu($row);
        return view('Product::frontend.detail', $data);
    }

    //tomorow fix
    public function quick_view(Request $request,$id){
        $product = Product::where('id',$id)->first();
        $translation = $product->translate(app()->getLocale());
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
        $product = Product::find($request->post('id'));
        $v_price = ($product->product_type == 'variable') ? getMinMaxPriceProductVariations($product) : [];
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
        ];
    }

    public function remove_compare(Request $request){
        $compare = session('compare');
        $n_compare = [];
        $listAttr = Attribute::all();
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

    public function store_list(){
        $data = [
            'users'         =>  User::paginate(2),
            'breadcrumbs'   =>  [
                [
                    'url'=>'',
                    'name'=> __('Store List')
                ]
            ]
        ];
        return view('Product::frontend.storeList.index', $data);
    }
}
