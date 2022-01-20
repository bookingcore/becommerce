<?php

    namespace Plugins\PaymentFlutterWaveCheckout\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Modules\Booking\Models\Booking;
    use Modules\Booking\Models\Payment;
    use Plugins\PaymentFlutterWaveCheckout\Gateway\FlutterWaveCheckoutGateway;


    class FlutterWaveCheckoutController extends Controller
    {
        protected $booking;
        /**
         * @var string
         */
        private $payment;

        public function __construct()
        {
            $this->booking = Booking::class;
            $this->payment = Payment::class;
        }

        public function handleCheckout(Request $request, $code)
        {
            if (!empty($code)) {
                $booking = $this->booking::where('code', $code)->first();
                if (empty($booking)) {
                    return redirect('/');
                }
                if ($booking->customer_id != Auth::id()) {
                    return redirect('/');
                }

//                if ($booking->status == 'draft') {
//                    return redirect('/');
//                }
                $gateway = new FlutterWaveCheckoutGateway();
                $data = $gateway->handlePurchaseData([], $booking, $booking->service);
                return view("PaymentFlutterWaveCheckout::frontend.checkout", ['booking' => $booking, 'data' => $data, 'code' => $code]);
            } else {
                return redirect('/');
            }
        }

        public function handleCheckoutNormal(Request $request, $code)
        {
            if (!empty($code)) {
                $booking = $this->payment::where('code', $code)->first();
                if (empty($booking)) {
                    return redirect('/');
                }
                if ($booking->create_user != Auth::id()) {
                    return redirect('/');
                }

                $gateway = new FlutterWaveCheckoutGateway();
                $data = $gateway->handlePurchaseData($booking);
                $data['checkoutNormal']  = 1;
                return view("PaymentFlutterWaveCheckout::frontend.checkout", ['booking' => $booking, 'data' => $data, 'code' => $code]);
            } else {
                return redirect('/');
            }
        }

        public function confirmCheckout(Request $request, $code)
        {
            $FlutterWaveCheckoutGateway = new FlutterWaveCheckoutGateway();
            $request->merge(['code'=>$code]);
            return $FlutterWaveCheckoutGateway->confirmPayment($request);

        }

        public function webhookCheckout(){
            $request = \request();
            $data = $request->query('data',[]);
            $code = $data['tx_ref']??"";
            if(!empty($code)){
                $FlutterWaveCheckoutGateway = new FlutterWaveCheckoutGateway();
                $request->merge(['code'=>$code]);
                $payment = Payment::where('code',$code)->where('booking_id',null)->first();
                if(!empty($payment)){
                    $request->merge(['checkoutNormal'=>1]);
                }
                return $FlutterWaveCheckoutGateway->confirmPayment($request);
            }
        }

    }
