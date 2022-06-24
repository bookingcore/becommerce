<?php

    namespace Plugins\PaymentFlutterWaveCheckout\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Modules\Booking\Models\Booking;
    use Modules\Order\Models\Order;
    use Modules\Order\Models\Payment;
    use Plugins\PaymentFlutterWaveCheckout\Gateway\FlutterWaveCheckoutGateway;


    class FlutterWaveCheckoutController extends Controller
    {

        protected Order $order;

        public function __construct(Order $order)
        {
            $this->order = $order;
        }

        public function handleCheckout(Request $request, $order_id)
        {
            if (!empty($order_id)) {
                $order = $this->order::find($order_id);
                if (empty($order)) {
                    return redirect('/');
                }
                if ($order->customer_id != Auth::id()) {
                    return redirect('/');
                }
                $billing = $order->getJsonMeta('billing');
                $gateway = new FlutterWaveCheckoutGateway();
                $data = $gateway->handlePurchaseData([], $order);
                return view("PaymentFlutterWaveCheckout::frontend.checkout", ['order' => $order, 'data' => $data,'billing' => $billing]);
            } else {
                return redirect('/');
            }
        }


        public function confirmCheckout(Request $request, $order_id)
        {
            $FlutterWaveCheckoutGateway = new FlutterWaveCheckoutGateway();
            $request->merge(['oid'=>$order_id]);
            return $FlutterWaveCheckoutGateway->confirmPayment($request);
        }

        public function webhookCheckout(){
            $request = \request();
            $data = $request->query('data',[]);
            $oid = $data['tx_ref']??"";
            if(!empty($oid)){
                $FlutterWaveCheckoutGateway = new FlutterWaveCheckoutGateway();
                $request->merge(['oid'=>$oid]);
                return $FlutterWaveCheckoutGateway->confirmPayment($request);
            }
        }

    }
