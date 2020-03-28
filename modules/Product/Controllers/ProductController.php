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

        $is_ajax = $request->query('_ajax');
        $query = $this->product::query()->select("products.*");
        $query->where("products.status", "publish");

        if (!empty($price_range = $request->query('price_range'))) {
            $pri_from = explode(";", $price_range)[0];
            $pri_to = explode(";", $price_range)[1];
            $raw_sql_min_max = "( (products.sale_price > 0 and products.sale_price >= ? ) OR (products.sale_price <= 0 and products.price >= ? ) )
                            AND ( (products.sale_price > 0 and products.sale_price <= ? ) OR (products.sale_price <= 0 and products.price <= ? ) )";
            $query->whereRaw($raw_sql_min_max,[$pri_from,$pri_from,$pri_to,$pri_to]);
        }

        $terms = $request->query('terms');
        if (is_array($terms) && !empty($terms)) {
            $query->join('product_term as tt', 'tt.target_id', "products.id")->whereIn('tt.term_id', $terms);
        }
        $query->orderBy("id", "desc");
        $query->groupBy("products.id");

        $max_guests = (int)($request->query('adults') + $request->query('children'));
        if($max_guests){
            $query->where('max_guests','>=',$max_guests);
        }

        $list = $query->paginate(12);
        $markers = [];
        if (!empty($list)) {
            foreach ($list as $row) {
                $markers[] = [
                    "id"      => $row->id,
                    "title"   => $row->title,
                    "lat"     => (float)$row->map_lat,
                    "lng"     => (float)$row->map_lng,
                    "gallery" => $row->getGallery(true),
//                    "infobox" => view('Product::frontend.layouts.search.loop-gird', ['row' => $row,'disable_lazyload'=>1,'wrap_class'=>'infobox-item'])->render(),
                    'marker'  => url('images/icons/png/pin.png'),
                ];
            }
        }

        $cats_parent = ProductCategory::get_cats_parent();
        $categories = [];
        if (!empty($cats_parent)){
            foreach ($cats_parent as $parent){
                $childs = [];
                $cats_child = ProductCategory::where('parent_id',$parent['id'])->get();
                if (!empty($cats_child)){
                    foreach ($cats_child as $child){
                        array_push($childs, $child['name']);
                    }
                }
                array_push($categories, [
                    'cats_parent'   =>  $parent['name'],
                    'cats_child'    =>  $childs
                ]);
            }
        }

        $data = [
            'rows'               => $list,
            'product_min_max_price' => Product::getMinMaxPrice(),
            'markers'            => $markers,
            "blank"              => 1,
            'categories'         => $categories,

            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'class'=>'active',
                    'name'=>setting_item_with_lang('product_page_search_title',request()->query('lang'))
                ]
            ],
            'body_class'        => 'full_width ',
	        "seo_meta"           => Product::getSeoMetaForPageList()
        ];
        $layout = setting_item("product_layout_search", 'normal');
        if ($request->query('_layout')) {
            $layout = $request->query('_layout');
        }
        if ($is_ajax) {
            $this->sendSuccess([
                'html'    => view('Product::frontend.layouts.search-map.list-item', $data)->render(),
                "markers" => $data['markers']
            ]);
        }
        $data['attributes'] = Attributes::where('service', 'product')->get();
        $data['brands']  = ProductBrand::with(['products','translations'])->get()->map(function ($item){
        	$item->count_product  = count($item->products);
        	return $item;
        });
        if ($layout == "map") {
            $data['body_class'] = 'has-search-map';
            $data['html_class'] = 'full-page';
            return view('Product::frontend.search-map', $data);
        }

        return view('Product::frontend.search', $data);
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
        $related_products = '';
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
        }

        //dump($cats);
        $related = Product::get();
        $data = [
            'row'          => $row,
            'translation'  => $translation,
            'booking_data' => $row->getBookingData(),
            'review_list'  => $review_list,
            'related_list' => $related_products,
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'=>'is_single full_width style_default',
            'breadcrumbs'=>[
                [
                    'url'=>'',
                    'class'=>'active',
                    'name'=>$translation->title
                ]
            ]
        ];
        $this->setActiveMenu($row);

        return view('Product::frontend.detail', $data);
    }
}
