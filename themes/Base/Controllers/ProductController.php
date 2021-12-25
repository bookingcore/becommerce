<?php
namespace Themes\Base\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\News\Models\Tag;
use Modules\Product\Models\Product;
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
        $list = $this->_querySearch($request);
        $categories = ProductCategory::where('status', 'publish')->with(['translation'])->limit(999)->get()->toTree();
        $data = [
            'rows'               => $list->paginate(16),
            'product_min_max_price' => Product::getMinMaxPrice(),
            "blank"              => 1,
            'categories'         => $categories,
            'show_breadcrumb'    => 0,
            'breadcrumbs'=>[
                [
                    'name'=> (!empty($search)) ? 'Search Result For: "'.$search.'"' : 'Shop',
                ]
            ],
            'body_class'        => 'full_width',
            "seo_meta"           => Product::getSeoMetaForPageList()
        ];

        $data['attributes'] = Attributes::where('service', 'product')->where('status', 'publish')->with('terms.translation')->orderBy('position')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();

        return view('product', $data);
    }

    public function categoryIndex( $slug , Request $request){
        $category = ProductCategory::where('slug',$slug)->first();

        if(!$category){
            abort(404);
        }

        $list = $this->_querySearch($request,['cat_id'=>$category->id]);

        $categories = ProductCategory::where('status', 'publish')->with(['translation'])->limit(999)->get()->toTree();
        $data = [
            'rows'               => $list->paginate(16),
            'product_min_max_price' => Product::getMinMaxPrice(),
            "blank"              => 1,
            'categories'         => $categories,
            'show_breadcrumb'    => 0,
            'breadcrumbs'=>[
                [
                    'name'=> $category->name,
                ]
            ],
            'body_class'        => 'full_width',
            "seo_meta"           => Product::getSeoMetaForPageList()
        ];

        $data['attributes'] = Attributes::where('service', 'product')->where('status', 'publish')->with('terms.translation')->orderBy('position')->get();
        $data['brands']  = ProductBrand::with(['translation'])->where('status', 'publish')->get();
        return view('product', $data);
    }

    private function _querySearch($request , $filters = []){
        $query = $this->product::query()->select("products.*");
        $query->where("products.status", "publish");

        if (!empty($min_price = $request->query('min_price')) and !empty($max_price = $request->query('max_price'))) {
            $pri_from = $min_price;
            $pri_to = $max_price;
            $raw_sql_min_max = "( (IFNULL(products.sale_price,0) > 0 and products.sale_price >= ? ) OR (IFNULL(products.sale_price,0) <= 0 and products.price >= ?) )
								AND ( (IFNULL(products.sale_price,0) > 0 and products.sale_price <= ? ) OR (IFNULL(products.sale_price,0) <= 0 and products.price <= ?) )";
            $query->whereRaw($raw_sql_min_max,[$pri_from,$pri_from,$pri_to,$pri_to]);
        }

        $terms = $request->query('terms');
        if (is_array($terms) && !empty($terms)) {
            $query->join('product_term as tt', 'tt.target_id', "products.id")->whereIn('tt.term_id', $terms);
        }

        $review_scores = $request->query('review_score');
        if (is_array($review_scores) && !empty($review_scores)) {
            $where_review_score = [];
            foreach ($review_scores as $number){
                $decrease_number = $number - 1;
                $where_review_score[] = " ( products.review_score >= {$decrease_number}.5 AND products.review_score <= {$number}.9 ) ";
            }
            $sql_where_review_score = " ( " . implode("OR", $where_review_score) . " )  ";
            $query->WhereRaw($sql_where_review_score);
        }

        $brand = $request->query('brand');
        if (is_array($brand) && !empty($brand)){
            $query->whereIn('products.brand_id', $brand);
        }

        $tag = $request->query('tag');
        if (!empty($tag)){
            $tag_id = Tag::select('id')->where('slug',$tag)->first()->getAttribute('id');
            $query->join('product_tag','products.id','=','product_tag.target_id')->where('tag_id',$tag_id);
        }

        if(!empty($filters['cat_id'])){
            $query->join('product_category_relations as ctr', 'ctr.target_id', "products.id")->where('ctr.cat_id', $filters['cat_id']);
        }

        $search = $request->query('s');
        if (!empty($search)){
            $query->where('products.title','LIKE',"%$search%");
        }

        $query->orderBy("id", "desc");
        $query->groupBy("products.id");

        $list = $query->with(['hasWishList','brand']);

        return $list;
    }

    public function attrs($row){
        return Attributes::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get();
    }

    public function product_variations($row){
        $attrs = (!empty($row->attributes_for_variation)) ? Attributes::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get() : null;
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
        $translation = $row->translateOrOrigin(app()->getLocale());
        $review_list = Review::where('object_id', $row->id)->where('object_model', 'product')->where("status", "approved")->orderBy("id", "desc")->with('author')->paginate(setting_item('product_review_number_per_page', 5));
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
