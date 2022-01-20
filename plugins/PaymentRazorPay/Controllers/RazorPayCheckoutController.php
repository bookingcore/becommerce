<?php

namespace Plugins\PaymentRazorPay\Controllers;

use App\Http\Controllers\Controller;
use Eluceo\iCal\Property;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Order\Models\Payment;
use Plugins\PaymentRazorPay\Gateway\RazorPayCheckoutGateway;

class RazorPayCheckoutController extends Controller {
	public function handleCheckout(Request $request, $c, $r,$isNormal=false)
	{
		if ($c == '' || $r == '') {
			return redirect("/");
		}
		$razorPayGateway = new RazorPayCheckoutGateway();
		$keyId = $razorPayGateway->getKeyId();
		$keySecret = $razorPayGateway->getKeySecret();

		if($isNormal){
			$payment = Payment::where('code',$c)->first();
			if (!$payment) {
				return redirect('/');
			}
			$data = $razorPayGateway->handlePurchaseDataNormal([], $payment);
		}else{
			$booking = Booking::where('code', $c)->first();
			if (!$booking) {
				return redirect("/");
			}
			$data = $razorPayGateway->handlePurchaseData([], $booking, $booking->service, $booking->payment);

		}
		return view("PaymentRazorPay::frontend.razorpaycheckout",
				[
						'data'       => $data,
						'order_id'   => $r,
						'key'        => $keyId,
						'secret'     => $keySecret,
						'callback_url'=>route('processRazorPayGateway',['c'=>$c,'r'=>$r,'is_normal'=>$isNormal])
				]);
	}

	public function handleProcess(Request $request, $c, $r,$is_normal=false)
	{
		$razorPayGateway = new RazorPayCheckoutGateway();
		if($is_normal){
			return $razorPayGateway->confirmRazorPaymentNormal($request,$c,$r);
		}
		return $razorPayGateway->confirmRazorPayment($request, $c, $r);
	}
}
