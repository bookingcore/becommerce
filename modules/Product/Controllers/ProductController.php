<?php
namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\BravoTerms;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttrs;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
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
//        dump($_GET);
        $data = $this->_querySearch($request);
        return view('Product::frontend.search', $data);
    }

    public function categoryIndex( $slug , Request $request){

        // lay tat ca category theop slug bao gom ca id con.  laf dang. mang? laf ID
        $getCats = ProductCategory::select('*')->where('slug',$slug)->first();
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
                $where_review_score[] = " ( products.review_score >= {$number} AND products.review_score <= {$number}.9 ) ";
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
//            $query->join('product_category_relations as ctr', 'ctr.target_id', "products.id")->whereIn('ctr.cat_id', $cat_id);
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

    public function listAttrs($row){
        return ProductAttrs::whereIn('id',$row)->get();
    }

    public function ProductVariationTerm($row){
        return ProductVariationTerm::select('*','bravo_attrs.id as attr_id','bravo_attrs.display_type','bravo_terms.name','bravo_terms.content')
            ->join('bravo_terms','product_variation_term.term_id','=','bravo_terms.id')
            ->join('bravo_attrs','bravo_terms.attr_id','=','bravo_attrs.id')
            ->where('product_variation_term.product_id',$row)->get();
    }

    public function list_variable($variable){
        $list_variable = [];
        if (!empty($variable)){
            foreach ($variable as $item){
                array_push($list_variable, $item->variation_id);
            }
        }
        return $list_variable;
    }

    public function get_variable($list_variable){
        $get_variation = [];
        if (!empty($list_variable)){
            foreach (array_unique($list_variable) as $item){
                $term_id = [];
                $terms = ProductVariationTerm::where('variation_id',$item)->get();
                $vProduct = ProductVariation::where('id',$item)->first();
                if (!empty($terms)){
                    foreach ($terms as $term){
                        array_push($term_id, $term->term_id);
                    }
                }
                sort($term_id);
                array_push($get_variation,[
                    'variation_id'  =>  $item,
                    'term_id'       =>  $term_id,
                    'vProduct_attr' =>  $vProduct->getAttributes(),
                ]);
            }
        }
        return $get_variation;
    }



    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->where("status", "publish")->first();
        $listAttrs = (!empty($row->attributes_for_variation)) ? $this->listAttrs($row->attributes_for_variation) : '';
        $variable = $this->ProductVariationTerm($row->id);
        $list_variable = $this->list_variable($variable);
        $get_variation = $this->get_variable($list_variable);

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
            'listAttrs'  => $listAttrs,
            'variable'  =>  $variable,
            'variations_product'    =>  json_encode($get_variation)
        ];
        $this->setActiveMenu($row);
        return view('Product::frontend.detail', $data);
    }

    public function quick_view(Request $request){
        $id = (!empty($request->id)) ? $request->id : '';
        $product = Product::where('id',$id)->first();
        $brand = ProductBrand::where('id',$product->brand_id)->first();
        $translation = $product->translateOrOrigin(app()->getLocale());
        $listAttrs = (!empty($product->attributes_for_variation)) ? $this->listAttrs($product->attributes_for_variation) : '';
        $variable = $this->ProductVariationTerm($product->id);
        $list_variable = $this->list_variable($variable);
        $get_variation = $this->get_variable($list_variable);

        $data = [
            'row'   =>  $product,
            'translation'  => $translation,
            'brand'     =>  $brand,
            'listAttrs'  => $listAttrs,
            'variable'  =>  $variable,
            'variations_product'    =>  json_encode($get_variation)
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
