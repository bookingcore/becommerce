<?php

    namespace Plugins\PaymentFlutterWaveCheckout\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Modules\Booking\Models\Booking;
    use Modules\Order\Models\Payment;
    use Plugins\PaymentFlutterWaveCheckout\Gateway\FlutterWaveCheckoutGateway;


    class FlutterWaveCheckoutController extends Controller
    {
        private $payment;

        public function __construct()
        {
            $this->payment = Payment::class;
        }

        public function handleCheckout(Request $request, $payment_id)
        {
            if (!empty($payment_id)) {
                $payment = $this->payment::find($payment_id);
                if (empty($payment)) {
                    return redirect('/');
                }
                $order = $payment->order;
                if ($order->customer_id != Auth::id()) {
                    return redirect('/');
                }
                $billing = $order->getJsonMeta('billing');
                $gateway = new FlutterWaveCheckoutGateway();
                $data = $gateway->handlePurchaseData([], $payment);
                return view("PaymentFlutterWaveCheckout::frontend.checkout", ['payment' => $payment, 'data' => $data,'billing' => $billing]);
            } else {
                return redirect('/');
            }
        }


        public function confirmCheckout(Request $request, $payment_id)
        {
            $FlutterWaveCheckoutGateway = new FlutterWaveCheckoutGateway();
            $request->merge(['pid'=>$payment_id]);
            return $FlutterWaveCheckoutGateway->confirmPayment($request);
        }

        public function webhookCheckout(){
            $request = \request();
            $data = $request->query('data',[]);
            $pid = $data['tx_ref']??"";
            if(!empty($pid)){
                $FlutterWaveCheckoutGateway = new FlutterWaveCheckoutGateway();
                $request->merge(['pid'=>$pid]);
                return $FlutterWaveCheckoutGateway->confirmPayment($request);
            }
        }

    }
