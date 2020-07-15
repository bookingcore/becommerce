<?php
namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\BravoTerms;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Models\ProductVariationTerm;
use Modules\Product\Models\Space;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Review\Models\Review;
use Modules\Core\Models\Attributes;
use DB;
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
        $data = $this->_querySearch($request);
        return view('Product::frontend.search', $data);
    }

    public function categoryIndex( $slug , Request $request){
        $getCats = ProductCategory::where('slug',$slug)->first();
        $categories = $getCats->id;
        $data = $this->_querySearch($request , [$categories]);
        return view('Product::frontend.categories', (isset($data)) ? $data : []);
    }

    private function _querySearch($request , $cats = false){
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

        if(!empty($cats)){
            $query->join('product_category_relations as ctr', 'ctr.target_id', "products.id")->whereIn('ctr.cat_id', $cats);
        }

        $cat_id = $request->query('category_id');
        $search = $request->query('s');
        if (!empty($cat_id)){
            $query->join('product_category_relations as ctr', 'products.id','=','ctr.target_id')->where('ctr.cat_id', $cat_id);
        }
        if (!empty($search)){
            $query->where('products.title','LIKE',"%$search%");
        }

        $query->orderBy("id", "desc");
        $query->groupBy("products.id");

        $list = $query->paginate(12);

        $categories = ProductCategory::where('status', 'publish')->with(['translations'])->limit(999)->get()->toTree();

        $data = [
            'rows'               => $list,
            'product_min_max_price' => Product::getMinMaxPrice(),
            "blank"              => 1,
            'categories'         => $categories,
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'class'=>'active',
                    'name'=> (!empty($search)) ? 'Search Result For: "'.$search.'"' : 'Shop',
                ]
            ],
            'wishlist'      =>  wishlist(),
            'body_class'        => 'full_width',
            "seo_meta"           => Product::getSeoMetaForPageList()
        ];

        $data['attributes'] = Attributes::where('service', 'product')->get();
        $data['brands']  = ProductBrand::with(['products','translations'])->get()->map(function ($item){
            $item->count_product  = count($item->products);
            return $item;
        });
        return $data;
    }

    public function attrs($row){
        return Attributes::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get();
    }

    public function product_variations($row){
        $attrs = (!empty($row->attributes_for_variation)) ? Attributes::select('id','name','display_type')->whereIn('id',$row->attributes_for_variation)->get() : null;
        $terms = ProductTerm::select('*','bravo_terms.attr_id as attr_id')->join('bravo_terms','product_term.term_id','=','bravo_terms.id')->where('target_id',$row->id)->get();
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



    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->where("status", "publish")->first();
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
        $data = [
            'row'          => $row,
            'translation'  => $translation,
            'booking_data' => $row->getBookingData(),
            'review_list'  => $review_list,
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'=>'is_single full_width style_default',
            'breadcrumbs'=> $c_breadcrumbs,
            'variations_product'    =>  json_encode($product_variations['variations_product']),
            'attrs_list' =>  $product_variations['attr_list']
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
                $product_variable = ProductVariationTerm::select('product_variation_term.*','bravo_terms.name','bravo_terms.attr_id')->join('bravo_terms','product_variation_term.term_id','=','bravo_terms.id')->where('product_id',$product->id)->get();
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
