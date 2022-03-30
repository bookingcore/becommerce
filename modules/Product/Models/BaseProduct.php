<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Http\Request;
use Modules\Media\Helpers\FileHelper;
use Modules\Review\Models\Review;

class BaseProduct extends BaseModel
{
    public $email_new_booking_file             = '';

    protected $reviewClass;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->reviewClass = Review::class;
    }

    public function sendError($message, $data = [])
    {
        $data['status'] = 0;
        return $this->sendSuccess($data, $message);
    }

    public function sendSuccess($data = [], $message = '')
    {
        if (!isset($data['status']))
            $data['status'] = 1;
        $data['message'] = $message;
        return response()->json($data);
    }

    public function addToCartValidate(Request $request)
    {
        return true;
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


    public function getImageUrlAttribute($size = "medium")
    {
        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }

    public function getBannerImageUrlAttribute($size = "medium")
    {
        $url = FileHelper::url($this->banner_image_id, $size);
        return $url ? $url : '';
    }

    public function getImageUrl($size = "medium")
    {

        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }


    public function filterCheckoutValidate(Request $request, $rules = [])
    {
        return $rules;
    }

    public function beforeCheckout(Request $request, $booking)
    {

    }

    public function afterCheckout(Request $request, $booking)
    {

    }

    public function beforePaymentProcess($booking, $payment)
    {

    }

    public function afterPaymentProcess($booking, $payment)
    {

    }

    /**
     * Get Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne("App\User", "id", 'create_user');
    }

    public function getDisplayPriceAttribute()
    {
        return format_money($this->price);
    }

    public function getDisplaySalePriceAttribute()
    {
        if (!empty($this->price) and $this->price > 0 and !empty($this->origin_price) and $this->origin_price > 0 and $this->price < $this->origin_price) {
            return format_money($this->origin_price);
        }
        return false;
    }

    public function getBookingsInRange($from,$to){

    }

    public static function getVendorServicesQuery($user_id){
        return parent::query()->where([
            'create_user'=>$user_id,
            'status'=>'publish',
        ])->with('location');
    }

    public function getRecommendPercentAttribute()
    {
        $percent = 0;
        $dataTotalReview = $this->reviewClass::selectRaw(" 	COUNT( id ) AS total_review, COUNT( CASE WHEN rate_number >= 4 THEN 1 ELSE null END )  as total_review_recommend ")->where('object_id', $this->id)->where('object_model', "tour")->where("status", "approved")->first();
        if(!empty($dataTotalReview['total_review'])){
            $percent = ( 100 / $dataTotalReview['total_review'] ) * $dataTotalReview['total_review_recommend'];
        }
        return $percent;
    }

    public function getBuyableIdentifier($options = NULL){
        return $this->id;
    }

    public function getBuyableDescription($options = NULL){
        return $this->title;
    }

    public function getBuyablePrice($options = NULL){
        return $this->price;
    }


    public function productOnHold(){
        return $this->hasMany(ProductOnHold::class,'product_id','id')->where('expired_at','>',now());
    }

    public function getOnHoldAttribute()
    {
        return $this->productOnHold()->sum('qty');
    }
    public function getRemainStockAttribute()
    {
        return $this->quantity - $this->on_hold;
    }

    public function stockValidation($qty)
    {
        $isManageStock  = $this->is_manage_stock();
        if(!empty($isManageStock)){
            $onHold = $this->on_hold;
            if(!empty($this->quantity)){
                $remainStock = $this->quantity - $onHold;
                if($qty>$remainStock){
                    throw new \Exception(__(':product_name remain stock: :remain remaining.',['product_name'=>$this->title,'remain'=>$remainStock]));
                }
            }else{
                throw new \Exception(__(':product_name is out of stock',['product_name'=>$this->title]));
            }
        }else{
            if($this->stock_status ==='out'){
                throw new \Exception(__(':product_name is out of stock',['product_name'=>$this->title]));
            }
        }
    }


    public function is_manage_stock(){
        if(setting_item('product_enable_stock_management')){
            return $this->is_manage_stock;
        }
        return false;
    }
}
