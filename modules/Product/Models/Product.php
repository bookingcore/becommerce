<?php

namespace Modules\Product\Models;

use App\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Campaign\Models\CampaignProduct;
use Modules\Core\Models\Attribute;
use Modules\Core\Models\Term;
use Modules\Media\Helpers\FileHelper;
use Modules\News\Models\Tag;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Product\Events\ProductDeleteEvent;
use Modules\Product\Traits\HasStockValidation;
use Modules\Review\Models\Review;
use Modules\User\Models\UserWishList;
use Themes\Base\Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute as AttributeCasts;

class Product extends BaseModel
{
    use HasFactory, HasStockValidation, SoftDeletes;
    protected $table = 'products';
    public $type = 'product';

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
        'origin_price',
        'status',
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    protected $seo_type = 'product';
    protected $casts = [
        'attributes_for_variation'=>'array',
        'price'=>'float'
    ];

    protected $cleanFields = [
        'content','short_desc'
    ];

    /**
     * @var Review
     */
    protected $reviewClass;

    protected $translation_class = ProductTranslation::class;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->reviewClass = Review::class;
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
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

    protected function typeName(): AttributeCasts
    {
        return AttributeCasts::make(
            get:function($value){
                switch ($this->product_type){
                    case "simple":
                        return __('Simple Product');
                    break;
                    case "variable":
                        return __('Variable Product');
                    break;
                    case "external":
                        return __('External Product');
                    break;
                }
            }
        );
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
        $meta['full_url'] = url()->current();
        return $meta;
    }


    public function terms(){
        return $this->hasMany(ProductTerm::class, "target_id");
    }

    public function getDetailUrl($locale = false)
    {
        return route('product.detail',['slug'=>$this->slug ?  $this->slug : $this->id]);
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
            if (!empty($large)){
                $thumb = FileHelper::url($item, 'thumb');
                $list_item[] = [
                    'large' => $large,
                    'thumb' => $thumb
                ];
            }
        }
        return $list_item;
    }

    public function getEditUrl()
    {
        return url(route('product.admin.edit',['id'=>$this->id]));
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
        $model = parent::selectRaw('MIN( min_price ) AS min_price ,
                                    MAX( max_price ) AS max_price ')->where("status", "publish")->first();
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
    public function getReviewNumberPerPage()
    {
        return setting_item("product_review_number_per_page", 5);
    }
    public static function getReviewStats()
    {
        return [];
    }

    public function isReviewRequirePurchase(){
        return (bool) setting_item('product_review_verification_required');
    }


    public function review_list(){
        return $this->hasMany(Review::class,'object_id')
            ->where('object_model', $this->type)
            ->where("status", "approved");
    }

    public function isBought(){
        $orderItem  =  OrderItem::where('object_id',$this->id)
            ->where('object_model',$this->type)
            ->whereIn('status',[Order::COMPLETED,Order::PAID])
            ->whereHas('order',function (Builder $builder){
                $builder->where('customer_id',Auth::id());
            })->count();
        return !empty($orderItem)?true:false;
    }

    protected function reviewData() : AttributeCasts
    {
        return AttributeCasts::make(
            get:function(){
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
        );

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
            $number = parent::join('core_locations', function ($join) use ($location) {
                $join->on('core_locations.id', '=', $this->table.'.location_id')->where('core_locations._lft', '>=', $location->_lft)->where('core_locations._rgt', '<=', $location->_rgt);
            })->where($this->table.".status", "publish")->count($this->table.".id");
        }
        if ($number > 1) {
            return __(":number Spaces", ['number' => $number]);
        }
        return __(":number Space", ['number' => $number]);
    }

    public function getStockStatus(){
        $stock = ''; $in_stock = true;
        if ($this->check_manage_stock() and $this->quantity){
            $stock = __('In Stock');
        } elseif(!$this->check_manage_stock() and $this->stock_status == 'in') {
            $stock = __('In Stock');
        }else{
            $stock = __('Out Of Stock');
            $in_stock = false;
        }

        return [
            'stock'     =>  $stock,
            'in_stock'  =>  $in_stock
        ];
    }


    /**
     * Single Tabs
     */
    public function tabs(): AttributeCasts
    {
        return AttributeCasts::make(
            get:function($value){
                $tabs = [
                    [
                        'id' => 'content',
                        'name' => __('Description'),
                        'position' => 10
                    ],
                    [
                        'id' => 'policies',
                        'name' => __('Policies'),
                        'position' => 40
                    ]
                ];
                if(is_vendor_enable()){
                    $tabs[] = [
                        'id' => 'vendor',
                        'name' => __('Vendor'),
                        'position' => 20
                    ];
                }
                if (setting_item('product_enable_review')){
                    $tabs[] =[
                        'id' => 'review',
                        'name' => __('Review'),
                        'position' => 30
                    ];
                }

                return array_values(\Illuminate\Support\Arr::sort($tabs, function ($value) {
                    return $value['position'] ?? 10;
                }));
            }
        );

    }

    public function categorySeeder(){
        return $this->belongsToMany(ProductCategory::class,ProductCategoryRelation::getTableName(),'target_id','cat_id');
    }
    public function termSeeder(){
        return $this->belongsToMany(Term::class,ProductTerm::getTableName(),'target_id','term_id');
    }
    public function tagsSeeder(){
        return $this->belongsToMany(ProductTag::class,ProductTagRelation::getTableName(),'target_id','tag_id');
    }
    public function review(){
        return $this->hasMany(Review::class,'object_id','id')->where('object_model',$this->type);
    }
    public function categories(){
        return $this->hasManyThrough(ProductCategory::class, ProductCategoryRelation::class,'target_id','id','id','cat_id');
    }
    public function tags(){
        return $this->hasManyThrough(ProductTag::class, ProductTagRelation::class,'target_id', 'id','id','tag_id');
    }
    public function brand(){
    	return $this->belongsTo(ProductBrand::class,'brand_id')->withDefault();
    }
    public function variations(){
    	return $this->hasMany(ProductVariation::class);
    }

    /**
     * In case of search_type = join_variation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variation(){
    	return $this->belongsTo(ProductVariation::class,'variant_id');
    }

	public function productJsAdminData(): AttributeCasts
    {
        return AttributeCasts::make(
            get:function($value){
                return [
                    'attributes'=>Attribute::query()->ofType($this->type)->get(),
                    'attributes_for_variation'=>$this->attributes_for_variation
                ];
            }
        );

    }

    public function getTermsOfAttr($attr_id)
    {
         return Term::query()->select('core_terms.*')->where('attr_id',$attr_id)->join('product_term as pt','pt.term_id','=','core_terms.id')->where('target_id',$this->id)->get();
    }

    public function attributesForVariationData(): AttributeCasts
    {
        return AttributeCasts::make(
          get:function($value){
                $res = [];
                if(!empty($this->attributes_for_variation) and is_array($this->attributes_for_variation))
                {
                    foreach ($this->attributes_for_variation as $attr_id) {
                        $attr = Attribute::find($attr_id);
                        if(empty($attr)) continue;

                        $res[$attr_id] = [
                            'attr'=>$attr,
                            'terms'=>$this->getTermsOfAttr($attr_id)
                        ];
                    }
                }
                return $res;
            }
        );

    }
    protected function get_stock($st, $pr){
        $sold = (!empty($pr->sold)) ? $pr->sold : 0;
        if ($pr->stock_status == 'in' && $pr->check_manage_stock()){
            $st = $pr->quantity - $sold;
        }
        return $st;
    }

    public function addToCartValidate($qty=1, $variant_id=null)
    {
        if($this->status != 'publish'){

            throw  new \Exception(__("Product is not published yet"),403);
        }

        if(!empty($variant_id)){
            $variation = $this->variations()->where('id',$variant_id)->first();
            if(!$variation){
                throw  new \Exception('Variation not found..',405);
            }
        }
        switch ($this->product_type){
            case 'variable':
                    $variant = $this->variations()->where('id',$variant_id)->first();
                    if(!empty($variant)){
                        if(!empty($this->check_manage_stock())){
                            if(!empty($this->quantity)){
                                $remainStock = $this->remain_stock;
                                if($qty>$remainStock){
                                    throw new \Exception(__(':product_name remain stock: :remain remaining.',['product_name'=>$this->title,'remain'=>$remainStock]),406);
                                }
                            }else{
                                throw new \Exception(__(':product_name is out of stock',['product_name'=>$this->title]),406);
                            }
                        }else{

                            $variant->stockValidation($qty);
                        }
                    }else{
                        throw new \Exception(__('Please select a variation'),407);
                    }
                break;
            case 'external':
                throw  new \Exception('Product type external. You cannot add to cart!',408);
                break;
            default:
                $this->stockValidation($qty);
                break;
        }

    }
    public function list_attrs(){
        return Attribute::select('id','name','slug')->get();
    }

    public function get_variable($id){
        return ProductVariationTerm::select('product_variation_term.*','core_terms.id as id_term','core_attrs.id as id_attrs')
                    ->join('core_terms','product_variation_term.term_id','=','core_terms.id')
                    ->join('core_attrs','core_terms.attr_id','=','core_attrs.id')
                    ->where('product_variation_term.product_id',$id)->get();
    }

    public function updateServiceRate(){
        $rateData = $this->reviewClass::selectRaw("AVG(rate_number) as rate_total")->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->first();
        $rate_number = number_format($rateData->rate_total ?? 0, 1);
        $this->review_score = $rate_number;
        $this->save();
    }
    public function scopeOfVendor($query,User $user){
        return $query->where('author_id',$user->id);
    }
    public function hasWishList(){
        return $this->hasOne(UserWishList::class, 'object_id','id')->where('object_model' , $this->type)->where('user_id' , Auth::id() ?? 0);
    }
    public function isWishList()
    {
        if (Auth::id()) {
            if (!empty($this->hasWishList) and !empty($this->hasWishList->id)) {
                return 'active';
            }
        }
        return '';
    }

    public static function search($filters)
    {
        $query = parent::query()->select("products.*");

        $query->where("products.status", "publish");

        if (!empty($filters['min_price']) and !empty($filters['max_price'])) {
            $raw_sql_min_max = "( ( products.min_price >= ? and products.min_price <= ? ) OR ( products.max_price >= ? and products.max_price <= ? ) )";
            $query->whereRaw($raw_sql_min_max,[$filters['min_price'],$filters['max_price'],$filters['min_price'],$filters['max_price']]);
        }

        if (!empty($filters['terms']) and is_array($filters['terms'])) {
            $query->join('product_term as tt', 'tt.target_id', "products.id")->whereIn('tt.term_id', $filters['terms']);
        }
        if (!empty($filters['review_score']) && is_array($filters['review_score'])) {
            $where_review_score = [];
            foreach ($filters['review_score'] as $number){
                $decrease_number = $number - 1;
                $where_review_score[] = " ( products.review_score >= {$decrease_number}.5 AND products.review_score <= {$number}.9 ) ";
            }
            $sql_where_review_score = " ( " . implode("OR", $where_review_score) . " )  ";
            $query->WhereRaw($sql_where_review_score);
        }

        if (!empty($filters['brand']) && is_array($filters['brand'])){
            $query->whereIn('products.brand_id', $filters['brand']);
        }

        if (!empty($filters['tag'])){
            $tag = ProductTag::select('id')->where('slug',$filters['tag'])->first();
            if($tag) {
                $query->join('product_tag_relation', 'products.id', '=', 'product_tag_relation.target_id')->where('tag_id', $tag->id);
            }
        }

        if (!empty($filters['cat_ids'])) {
            $category_ids = $filters['cat_ids'];
            $query->join('product_category_relations', function ($join) use ($category_ids) {
                $join->on('products.id', '=', 'product_category_relations.target_id')
                    ->whereIn('product_category_relations.cat_id', $category_ids);
            });
        }

        if (!empty($filters['category_id'])){
            $query->join('product_category_relations as ctr', 'products.id','=','ctr.target_id')->where('ctr.cat_id', $filters['category_id']);
        }

        if (!empty($filters['s'])){
            $search = $filters['s'];
            $query->where('products.title','LIKE',"%$search%");
        }

        if(!empty($filters['is_featured']))
        {
            $query->where('products.is_featured',1);
        }

        if(!empty($filters['vendor_id']))
        {
            $query->where('products.author_id',$filters['vendor_id']);
        }

        if(setting_item('product_hide_products_out_of_stock'))
        {
            $query->where('stock_status','in');
        }

        $orderby = $filters['order_by'] ?? "desc";
        $order = $filters['order'] ?? $filters['sort'] ?? "id";

        switch ($order){
            case "price_asc":
                $query->orderBy("products.min_price", "asc");
                break;
            case "price_desc":
                $query->orderBy("products.min_price", "desc");
                break;
            case "rate":
                $query->orderBy("review_score", $orderby);
                break;
            case"id":
            case"title":
                $query->orderBy("products.".$order, $orderby);
            break;
            default:
                $query->orderBy("is_featured", "desc");
                $query->orderBy("id", "desc");
        }

        if(!empty($filters['search_type'])) {
            switch ($filters['search_type']) {
                case "join_variation":
                    $variation_table = ProductVariation::getTableName();
                    $query->leftJoin($variation_table, $variation_table . '.product_id', 'products.id');
                    $query->addSelect(DB::raw($variation_table . '.id as `variant_id`'));
                    $query->with('variation');
                    $query->groupBy(['products.id', 'variant_id']);
                    break;
            }
        }
        $query->groupBy("products.id");
        return $query->with(['hasWishList','brand','translation']);
    }

    public function variationMappingResource(){
        if(empty($data_variations = $this->variations))
            return false;
        $list_variations = $list_attributes=  [];
        foreach($data_variations as  $variation){
            if(empty($variation->isActive($this->check_manage_stock()))) continue;

            $variation->setRelation('parent',$this);

            $term_ids = $variation->term_ids;
            $list_variations[$variation->id] = ['variation_id'=>$variation->id,'variation'=>$variation->getAttributesForDetail($this)];
            foreach($this->attributes_for_variation_data as $item){
                foreach($item['terms'] as $term){
                    if(in_array($term->id,$term_ids)){
                        $list_variations[$variation->id]['terms'][] = ["id"=>$term->id,"title"=> $term->name];
                        $list_attributes[ $item['attr']->name ][$term->id] = [
                            'name'=>$term->name,
                            'color'=>$term->content,
                            'image'=>"",
                            'type'=>$item['attr']->display_type,
                        ];
                    }
                }
            }
        }
        return [
            'variations'=>$list_variations,
            'attributes'=>$list_attributes,
        ];
    }

    public function active_campaign(){
        return $this->hasOne(CampaignProduct::class,'product_id')->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->where('status','active');
    }

    public function updateMinMaxPrice(){
        $this->min_price = $this->price;
        $this->max_price = $this->price;
        if ($this->product_type == 'variable') {
            if (!empty($variations  = $this->variations)) {
                $this->min_price = $variations->min('price')??$this->price;
                $this->max_price = $variations->max('price')??$this->price;
            }
        }
        $active_campaign = $this->active_campaign;
        if($active_campaign and $active_campaign->isActiveNow()){
            $this->min_price -= $active_campaign->discount_amount * $this->min_price;
        }
    }


    public function cartExtraParams(Request $request){
        return [];
    }
    /**
     * Is Tax included in Pricing
     */
    public function isTaxIncluded()
    {
        return true;
    }


    public function getImageUrl($size = "medium")
    {

        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }

    protected function discountPercent(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get:function(){
                $price = $this->sale_price;
                if (  $price < $this->origin_price) {
                    $percent = 100 - ceil($price / ($this->origin_price / 100));
                    return $percent;
                }
                return null;
            }
        );
    }
    protected function salePrice(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return AttributeCasts::make(
            get:function(){
                $price = $this->price;
                $active_campaign  = $this->active_campaign;
                if($active_campaign and $active_campaign->isActiveNow()){
                    $price -= $price * $active_campaign->discount_amount/100;
                }

                return $price;
            }
        );
    }
    protected function displayPrice(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return AttributeCasts::make(
            get:function(){
                return format_money($this->sale_price);
            }
        );
    }
    protected function displaySalePrice(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return AttributeCasts::make(
            get:function(){
                $price = $this->sale_price;
                if ($this->origin_price > $price) {
                    return format_money($this->origin_price);
                }
                return false;
            }
        );
    }

    public function delete()
    {
        ProductDeleteEvent::dispatch($this);
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    public function related(){

        $query = parent::query()->select('products.*')->where('products.status','publish')
            ->where('products.id','!=',$this->id);

        if($cats = $this->categories){
            $cats->join(ProductCategoryRelation::getTableName().' as cats_relations','cats_relations.target_id','=','products.id');
            $cats->whereIn('cats_relations.cat_id',$cats->pluck('id'));

        }elseif($brand = $this->brand){
            $cats->where('brand_id',$brand);
        }

        return $query;
    }
}
