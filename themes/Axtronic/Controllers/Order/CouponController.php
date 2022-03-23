<?php
namespace Themes\Base\Controllers\Order;

use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Coupon\Models\Coupon;
use Modules\Order\Helpers\CartManager;
use Themes\Base\Controllers\FrontendController;

class CouponController extends FrontendController
{

    public function applyCoupon(Request $request){
        $validator = \Validator::make($request->all(), [
            'coupon_code' => 'required',
        ]);
        $coupon_code = $request->input('coupon_code');
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $coupon = Coupon::where('code',$coupon_code)->where("status","publish")->first();
        if(empty($coupon)){
            return $this->sendError( __("Invalid coupon code!"));
        }
        $res = $coupon->applyCoupon();
        if($res['status']==1){
            $res['reload'] = 1;
        }
        return $this->sendSuccess($res, $res['message'] ?? "");
    }

    public function removeCoupon(Request $request){
        $coupon = Coupon::where('code',$request->input('coupon_code'))->where("status","publish")->first();
        if(empty($coupon)){
            return $this->sendError( __("Invalid coupon code!"));
        }
        $couponCart = CartManager::getCoupon();
        if($couponCart->where('id',$coupon->id)->first()){
            CartManager::removeCounpon($coupon);
            $res =  [
                'reload'=>1,
                'status'=>1,
                'message'=> __("Coupon code is remove already!")
            ];
        }else{
            $res =  [
                'status'=>0,
                'message'=> __("Coupon code not exits!")
            ];
        }

        return $this->sendSuccess($res);
    }
}
