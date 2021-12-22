<?php

namespace Modules\Product\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Modules\Core\Models\Attributes;
use Modules\Core\Models\Terms;
use Modules\Media\Helpers\FileHelper;
use Modules\News\Models\Tag;
use Modules\Review\Models\Review;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\User\Models\UserWishList;

class Product extends BaseProduct
{
    protected $table = 'products';
    public $type = 'product';
    public $checkout_booking_detail_file       = 'Product::frontend/booking/detail';
    public $checkout_booking_detail_modal_file = 'Product::frontend/booking/detail-modal';
    public $email_new_booking_file             = 'Product::emails.new_booking_detail';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_id',
        'banner_image_id',
        'short_desc',
        'category_id',
        'brand_id',
        'is_featured',
        'shipping_class',
        'gallery',
        'video',
        'price',
        'sale_price',
        'status'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    protected $seo_type = 'product';
    protected $casts = [
        'attributes_for_variation'=>'array'
    ];

    protected $cleanFields = [
        'content','short_desc'
    ];

    /**
     * @var Review
     */
    protected $reviewClass;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->reviewClass = Review::class;
    }

    public static function getModelName()
    {
        return __("Product");
    }

    public static function getTableName()
    {
        return with(new static)->table;
    }

    public static function getTypeName(){
        return __('Simple Product');
    }

    /**
     * Get SEO fop page list
     *
     * @return mixed
     */
    static public function getSeoMetaForPageList()
    {
        $meta['seo_title'] = __("Search for Products");
        if (!empty($title = setting_item_with_lang("product_page_list_seo_title",false))) {
            $meta['seo_title'] = $title;
        }else if(!empty($title = setting_item_with_lang("product_page_search_title"))) {
            $meta['seo_title'] = $title;
        }
        $meta['seo_image'] = null;
        if (!empty($title = setting_item("product_page_list_seo_image"))) {
            $meta['seo_image'] = $title;
        }else if(!empty($title = setting_item("product_page_search_banner"))) {
            $meta['seo_image'] = $title;
        }
        $meta['seo_desc'] = setting_item_with_lang("product_page_list_seo_desc");
        $meta['seo_share'] = setting_item_with_lang("product_page_list_seo_share");
        $meta['full_url'] = route('product.index');
        return $meta;
    }


    public function terms(){
        return $this->hasMany(ProductTerm::class, "target_id");
    }

    public function getDetailUrl($locale = false)
    {
        return route('product.detail',['slug'=>$this->slug]);
    }

    public static function getLinkForPageSearch( $locale = false , $param = [] ){

        return url(app_get_locale(false , false , '/'). 'product'."?".http_build_query($param));
    }

    public function getGallery($featuredIncluded = false)
    {
        if (empty($this->gallery))
            return $this->gallery;
        $list_item = [];
        if ($featuredIncluded and $this->image_id) {
            $list_item[] = [
                'large' => FileHelper::url($this->image_id, 'full'),
                'thumb' => FileHelper::url($this->image_id, 'thumb')
            ];
        }
        $items = explode(",", $this->gallery);
        foreach ($items as $k => $item) {
            $large = FileHelper::url($item, 'full');
            $thumb = FileHelper::url($item, 'thumb');
            $list_item[] = [
                'large' => $large,
                'thumb' => $thumb
            ];
        }
        return $list_item;
    }

    public function getEditUrl()
    {
        return url(route('space.admin.edit',['id'=>$this->id]));
    }

    public function getDiscountPercentAttribute()
    {
        if (    !empty($this->price) and $this->price > 0
            and !empty($this->sale_price) and $this->sale_price > 0
            and $this->price > $this->sale_price
        ) {
            $percent = 100 - ceil($this->sale_price / ($this->price / 100));
            return $percent . "%";
        }
    }

    public function fill(array $attributes)
    {
        if(!empty($attributes)){
            foreach ( $this->fillable as $item ){
                $attributes[$item] = $attributes[$item] ?? null;
            }
        }
        return parent::fill($attributes); // TODO: Change the autogenerated stub
    }

    public function getBookingData()
    {
        $booking_data = [
            'id'           => $this->id,
            'person_types' => [],
            'max'          => 0,
            'open_hours'   => [],
            'extra_price'  => [],
            'minDate'      => date('m/d/Y'),
            'max_guests' =>$this->max_guests  ?? 1
        ];
        return $booking_data;
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if (strlen($q)) {

            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public static function getMinMaxPrice()
    {
        $model = parent::selectRaw('MIN( CASE WHEN sale_price > 0 THEN sale_price ELSE ( price ) END ) AS min_price ,
                                    MAX( CASE WHEN sale_price > 0 THEN sale_price ELSE ( price ) END ) AS max_price ')->where("status", "publish")->first();
        if (empty($model->min_price) and empty($model->max_price)) {
            return [
                0,
                100
            ];
        }
        return [
            $model->min_price,
            $model->max_price
        ];
    }

    public function getReviewEnable()
    {
        return setting_item("product_enable_review", 1);
    }

    public function getReviewApproved()
    {
        return setting_item("product_review_approved", 1);
    }

    public function check_enable_review_after_booking()
    {
        $option = setting_item("product_enable_review_after_booking", 0);
        if ($option) {
            $number_review = $this->reviewClass::countReviewByServiceID($this->id, Auth::id()) ?? 0;
            $number_booking = $this->bookingClass::countBookingByServiceID($this->id, Auth::id()) ?? 0;
            if ($number_review >= $number_booking) {
                return false;
            }
        }
        return true;
    }

    public static function getReviewStats()
    {
        $reviewStats = [];
        if (!empty($list = setting_item("product_review_stats", []))) {
            $list = json_decode($list, true);
            foreach ($list as $item) {
                $reviewStats[] = $item['title'];
            }
        }
        return $reviewStats;
    }

    public function getReviewDataAttribute()
    {
        $list_score = [
            'score_total'  => 0,
            'score_text'   => __("Not Rate"),
            'total_review' => 0,
            'rate_score'   => [],
        ];
        $dataTotalReview = $this->reviewClass::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->first();
        if (!empty($dataTotalReview->score_total)) {
            $list_score['score_total'] = number_format($dataTotalReview->score_total, 1);
            $list_score['score_text'] = Review::getDisplayTextScoreByLever(round($list_score['score_total']));
        }
        if (!empty($dataTotalReview->total_review)) {
            $list_score['total_review'] = $dataTotalReview->total_review;
        }
        for ($rate = 5; $rate >= 1; $rate--) {
            $number = $this->reviewClass::where('rate_number', $rate)->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->count();
            if (!empty($list_score['total_review'])) {
                $percent = ($number / $list_score['total_review']) * 100;
            } else {
                $percent = 0;
            }
            $list_score['rate_score'][$rate] = [
                'title'   => $this->reviewClass::getDisplayTextScoreByLever($rate),
                'total'   => $number,
                'percent' => round($percent),
            ];
        }
        return $list_score;
    }

    /**
     * Get Score Review
     *
     * Using for loop space
     */
    public function getScoreReview()
    {
        $product_id = $this->id;
        $list_score = Cache::rememberForever('review_'.$this->type.'_' . $product_id, function () use ($product_id) {
            $dataReview = $this->reviewClass::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $product_id)->where('object_model', $this->type)->where("status", "approved")->first();
            $score_total = !empty($dataReview->score_total) ? number_format($dataReview->score_total, 1) : 0;
            return [
                'score_total'  => $score_total,
                'total_review' => !empty($dataReview->total_review) ? $dataReview->total_review : 0,
                'review_text'   => $score_total ? Review::getDisplayTextScoreByLever( round( $score_total )) : __("Not rate"),
            ];
        });

        return $list_score;
    }

    public function getNumberReviewsInService($status = false)
    {
        return $this->reviewClass::countReviewByServiceID($this->id, false, $status,$this->type) ?? 0;
    }

    public function getNumberServiceInLocation($location)
    {
        $number = 0;
        if(!empty($location)) {
            $number = parent::join('bc_locations', function ($join) use ($location) {
                $join->on('bc_locations.id', '=', $this->table.'.location_id')->where('bc_locations._lft', '>=', $location->_lft)->where('bc_locations._rgt', '<=', $location->_rgt);
            })->where($this->table.".status", "publish")->count($this->table.".id");
        }
        if ($number > 1) {
            return __(":number Spaces", ['number' => $number]);
        }
        return __(":number Space", ['number' => $number]);
    }

    /**
     * @param $from
     * @param $to
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBookingsInRange($from,$to){

        $query = $this->bookingClass::query();
        $query->whereNotIn('status',['draft']);
        $query->where('start_date','<=',$to)->where('end_date','>=',$from)->take(50);

        $query->where('object_id',$this->id);
        $query->where('object_model',$this->type);

        return $query->orderBy('id','asc')->get();

    }

    public function getStockStatus(){
        $stock = ''; $in_stock = true;
        if ($this->is_manage_stock > 0){
            if ($this->stock_status == 'in'){
                $stock = __(':count in stock',['count'=>$this->quantity - $this->sold]);
            }
        } else {
            $stock = ($this->stock_status == 'in') ? __('In Stock') : '';
        }
        if ($this->stock_status == 'out'){
            $stock = __('Out Of Stock');
            $in_stock = false;
        }
        return [
            'stock'     =>  $stock,
            'in_stock'  =>  $in_stock
        ];
    }

    public function getStockStatusCodeAttribute(){
        if(!$this->is_manage_stock){
            return 'in_stock';
        }
        switch ($this->stock_status){
            case 'in':
                return 'in_stock';
                break;
            case 'out':
                return 'out_stock';
                break;

        }
    }
    public function getStockStatusTextAttribute(){
        if(!$this->manage_stock){
            return __('In Stock');
        }
        switch ($this->stock_status){
            case 1:
                return __('In Stock');
                break;
            case 0:
                return __("Out Stock");
                break;

        }
    }

    /**
     * Single Tabs
     */
    public function getTabsAttribute(){
        $getTabs = [
            [
                'id' => 'content',
                'name' => __('description'),
                'position' => 10
            ],
            [
                'id' => 'specification',
                'name' => __('Specification'),
                'position' => 20
            ],
            [
                'id' => 'vendor',
                'name' => __('Vendor'),
                'position' => 30
            ],
            [
                'id' => 'review',
                'name' => __('Review'),
                'position' => 40
            ],
            [
                'id' => 'policies',
                'name' => __('Policies'),
                'position' => 50
            ]
        ];
        if (empty(setting_item('product_enable_review'))){
            unset($getTabs[3]);
        }
        $tabs = $getTabs;

        return array_values(\Illuminate\Support\Arr::sort($tabs, function ($value) {
            return $value['position'] ?? 10;
        }));
    }

    public function categories(){
        return $this->hasManyThrough(ProductCategory::class, ProductCategoryRelation::class,'target_id','id','id','cat_id');
    }
    public function tags(){
        return $this->hasManyThrough(Tag::class, ProductTag::class,'target_id', 'id','id','tag_id');
    }
    public function brand(){
    	return $this->belongsTo(ProductBrand::class,'brand_id')->withDefault();
    }
    public function variations(){
    	return $this->hasMany(ProductVariation::class);
    }
	public function getMinMaxPriceProductVariations(){
    	if($this->product_type=='variable'){
		    $array = $this->variations()->pluck('price')->toArray();
		    $array= array_values(Arr::sort($array));
		    return ['min'=>head($array),'max'=>last($array)];
	    }
	}
	public function getSameBrandAttribute(){
		return Product::where('id','!=',$this->id)->where("status", "publish")->where("brand_id", $this->brand_id)->take(3)->inRandomOrder()->get();
	}

	public function getProductJsAdminDataAttribute(){
        return [
            'attributes'=>Attributes::query()->ofType($this->type)->get(),
            'attributes_for_variation'=>$this->attributes_for_variation
        ];
    }

    public function getTermsOfAttr($attr_id)
    {
         return Terms::query()->select('core_terms.*')->where('attr_id',$attr_id)->join('product_term as pt','pt.term_id','=','core_terms.id')->where('target_id',$this->id)->get();
    }

    public function getAttributesForVariationDataAttribute(){
	    $res = [];
	    if(!empty($this->attributes_for_variation) and is_array($this->attributes_for_variation))
        {
            foreach ($this->attributes_for_variation as $attr_id) {
                $attr = Attributes::find($attr_id);
                if(empty($attr)) continue;

                $res[$attr_id] = [
                    'attr'=>$attr,
                    'terms'=>$this->getTermsOfAttr($attr_id)
                ];
            }
        }
	    return $res;
    }
    protected function get_stock($st, $pr){
        $sold = (!empty($pr->sold)) ? $pr->sold : 0;
        if ($pr->stock_status == 'in' && $pr->is_manage_stock == 1){
            $st = $pr->quantity - $sold;
        }
        return $st;
    }
    public function addToCart(Request $request)
    {
        $quantity = (!empty($request->input('qty'))) ? $request->input('qty') : 1;
        $stock = $add = 0;

        if (Cart::count() > 0){
            foreach (Cart::content() as $row){
                if ($row->id == $request->input('id')){
                    $stock = $this->get_stock($stock,$this);
                    if ($row->qty + $request->input('qty') > $stock){
                        $add = 1;
                    }
                }
            }
            if ($stock <= 0){$add = 0;}
        } else {
            $add = 0;
        }
        if ($add == 0) {Cart::add($this,$quantity);}

        $buy_now = $request->input('buy_now');
        $message = ($add == 0) ? __('":title" has been added to your cart.',['title'=>$this->title]) : __('Product ":title" has been out of stock.',['title'=>$this->title]);

        return $this->sendSuccess(
            [
                'status'   => ($add == 0) ? 1 : 0,
                'fragments'=>get_cart_fragments(),
                'url'=>$buy_now ? route('booking.checkout') : ''
            ], $message
        );
    }

    public function list_attrs(){
        return Attributes::select('id','name','slug')->get();
    }

    public function get_variable($id){
        return ProductVariationTerm::select('product_variation_term.*','core_terms.id as id_term','core_attrs.id as id_attrs')
                    ->join('core_terms','product_variation_term.term_id','=','core_terms.id')
                    ->join('core_attrs','core_terms.attr_id','=','core_attrs.id')
                    ->where('product_variation_term.product_id',$id)->get();
    }

    public function update_service_rate(){
        $rateData = $this->reviewClass::selectRaw("AVG(rate_number) as rate_total")->where('object_id', $this->id)->where('object_model',$this->type)->where("status", "approved")->first();
        $rate_number = number_format( $rateData->rate_total ?? 0 , 1);
        $this->review_score = $rate_number;
        $this->save();
    }
    public function hasWishList(){
        return $this->hasOne(UserWishList::class, 'object_id','id')->where('object_model' , $this->type)->where('user_id' , Auth::id() ?? 0);
    }
}
