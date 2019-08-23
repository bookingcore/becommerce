<?php
namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Models\Product;
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

        $list = $query->with('location')->paginate(9);
        $markers = [];
        if (!empty($list)) {
            foreach ($list as $row) {
                $markers[] = [
                    "id"      => $row->id,
                    "title"   => $row->title,
                    "lat"     => (float)$row->map_lat,
                    "lng"     => (float)$row->map_lng,
                    "gallery" => $row->getGallery(true),
                    "infobox" => view('Product::frontend.layouts.search.loop-gird', ['row' => $row,'disable_lazyload'=>1,'wrap_class'=>'infobox-item'])->render(),
                    'marker'  => url('images/icons/png/pin.png'),
                ];
            }
        }

        $data = [
            'rows'               => $list,
            'product_min_max_price' => Product::getMinMaxPrice(),
            'markers'            => $markers,
            "blank"              => 1,
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

        if ($layout == "map") {
            $data['body_class'] = 'has-search-map';
            $data['html_class'] = 'full-page';
            return view('Product::frontend.search-map', $data);
        }
        return view('Product::frontend.search', $data);
    }

    public function detail(Request $request, $slug)
    {
        $row = $this->product::where('slug', $slug)->where("status", "publish")->first();;
        if (empty($row)) {
            return redirect('/');
        }
        $translation = $row->translateOrOrigin(app()->getLocale());
        
        $review_list = Review::where('object_id', $row->id)->where('object_model', 'product')->where("status", "approved")->orderBy("id", "desc")->with('author')->paginate(setting_item('product_review_number_per_page', 5));
        $data = [
            'row'          => $row,
            'translation'       => $translation,
            'booking_data' => $row->getBookingData(),
            'review_list'  => $review_list,
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
