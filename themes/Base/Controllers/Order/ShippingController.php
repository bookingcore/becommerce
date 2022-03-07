<?php
namespace Themes\Base\Controllers\Order;

use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Coupon\Models\Coupon;
use Modules\Order\Helpers\CartManager;
use Modules\Product\Models\ShippingZone;
use Themes\Base\Controllers\FrontendController;

class ShippingController extends FrontendController
{

    public function calculateShipping(Request $request){
        $validator = \Validator::make($request->all(), [
            'country' => 'required',
        ]);

        $shipping = new ShippingZone();
        $res = $shipping->calculateShipping($request->input());
        if($res['status']==1){
            $res['reload'] = 1;
        }
        return $this->sendSuccess($res);
    }

}
