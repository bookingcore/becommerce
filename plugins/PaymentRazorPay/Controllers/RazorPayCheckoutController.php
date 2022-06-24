<?php

namespace Plugins\PaymentRazorPay\Controllers;

use App\Http\Controllers\Controller;
use Eluceo\iCal\Property;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;
use Plugins\PaymentRazorPay\Gateway\RazorPayCheckoutGateway;

class RazorPayCheckoutController extends Controller {
	public function handleCheckout(Request $request, $c, $r)
	{
		if ($c == '' || $r == '') {
			return redirect("/");
		}
		$razorPayGateway = new RazorPayCheckoutGateway();
		$keyId = $razorPayGateway->getKeyId();
		$keySecret = $razorPayGateway->getKeySecret();

        $order = Order::find($c);
        if (!$order) {
            return redirect("/");
        }
        $data = $razorPayGateway->handlePurchaseData([], $request,$order);
		return view("PaymentRazorPay::frontend.razorpaycheckout",
				[
						'data'       => $data,
						'order_id'   => $r,
						'key'        => $keyId,
						'secret'     => $keySecret,
						'callback_url'=>route('processRazorPayGateway',['c'=>$c,'r'=>$r])
				]);
	}

	public function handleProcess(Request $request, $c, $r)
	{
		$razorPayGateway = new RazorPayCheckoutGateway();
		return $razorPayGateway->confirmRazorPayment($request, $c, $r);
	}
}
