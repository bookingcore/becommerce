<?php
namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductCategoryRelation;
use Modules\Product\Models\Space;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Review\Models\Review;
use Modules\Core\Models\Attributes;
use DB;

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
                    'name'=>setting_item_with_lang('product_page_search_title',request()->query('lang'))
                ]
            ],
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

    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->where("status", "publish")->first();
        if (empty($row)) {
            return redirect('/');
        }
        $translation = $row->translateOrOrigin(app()->getLocale());


        $review_list = Review::where('object_id', $row->id)->where('object_model', 'product')->where("status", "approved")->orderBy("id", "desc")->with('author')->paginate(setting_item('product_review_number_per_page', 5));
        $cats = $row->categories;

        if (!empty($cats)){
            $c_breadcrumbs = [
                [
                    'name' => $cats[0]->name,
                    'url'  => route('product.category.index', ['slug'=>$cats[0]->slug])
                ],
                [
                    'url'=>'',
                    'class'=>'active',
                    'name'=>$translation->title
                ]
            ];
        } else {
            $c_breadcrumbs = [
                [
                    'url'=>'',
                    'class'=>'active',
                    'name'=>$translation->title
                ]
            ];
        }

        /*$related_products = '';
        if(!empty($cats)){
            $list_cat = [];
            foreach ($cats as $cat){
                $list_cat[] =  $cat->id;
            }
            $related_products = Product::query()
                ->join('product_category_relations', 'products.id', '=', 'product_category_relations.target_id')
                ->whereIn('product_category_relations.cat_id', $list_cat)
                ->whereNotIn('products.id', [$row->id])
                ->groupBy("products.id")
                ->get();
        }*/

        $related = Product::get();
        $data = [
            'row'          => $row,
            'translation'  => $translation,
            'booking_data' => $row->getBookingData(),
            'review_list'  => $review_list,
            /*'related_list' => $related_products,*/
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'=>'is_single full_width style_default',
            'breadcrumbs'=> $c_breadcrumbs
        ];
        $this->setActiveMenu($row);

        return view('Product::frontend.detail', $data);
    }
}
