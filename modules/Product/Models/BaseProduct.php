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
    public $checkout_booking_detail_modal_file = '';


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

    public function createDraftBooking()
    {

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

    /**
     * Get Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
//    public function location()
//    {
//        return $this->hasOne("Modules\Location\Models\Location", "id", 'location_id');
//    }

    /**
     * @todo Simple check before booking for status, etc
     */
    public function isBookable()
    {
        return true;
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

    public function getDisplayOriginPriceAttribute()
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

        if($this->sale_price and $this->sale_price < $this->price){
            return $this->sale_price;
        }
        return $this->price;
    }
}
