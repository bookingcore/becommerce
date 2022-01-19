<?php
namespace Plugins\PaymentFlutterWaveCheckout\Gateway;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mockery\Exception;
use Modules\Booking\Events\BookingCreatedEvent;
use Modules\Booking\Gateways\BaseGateway;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Payment;
use Illuminate\Support\Facades\Log;
use App\Helpers\Assets;
use SebastianBergmann\Comparator\Book;

class FlutterWaveCheckoutGateway extends BaseGateway
{
    protected $id = 'flutter_wave_checkout_gateway';
    public    $name            = 'FlutterWave Checkout';
    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable FlutterWave Standard?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("FlutterWave")
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Custom Logo'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description')
            ],
            [
                'type'  => 'input',
                'id'    => 'flutter_wave_api_key',
                'label' => __('Public Key'),
            ],
            [
                'type'  => 'input',
                'id'    => 'flutter_wave_api_secret_key',
                'label' => __('Secret Key'),
            ],
            [
                'type'  => 'input',
                'id'    => 'flutter_wave_api_encryption_key',
                'label' => __('Encryption Key'),
            ],

        ];
    }

    public function process(Request $request, $booking, $service)
    {
        if (in_array($booking->status, [
            $booking::PAID,
            $booking::COMPLETED,
            $booking::CANCELLED
        ])) {
            throw new Exception(__("Booking status does need to be paid"));
        }
        if (!$booking->total) {
            throw new Exception(__("Booking total is zero. Can not process payment gateway!"));
        }
        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_gateway = $this->id;

        $payment->save();
        $booking->status = $booking::UNPAID;
        $booking->payment_id = $payment->id;
        $booking->save();
        response()->json(['url' => route('checkoutFlutterWaveGateway',['order_id'=>$booking->code])])->send();
    }

    public function handlePurchaseData($data, $booking,  $service)
    {
        $data['public_key']= $this->getOption('flutter_wave_api_key');
        $data['amount'] = ((float)$booking->pay_now);
        $data['currency'] = setting_item('currency_main');
        $data['tx_ref'] = $booking->code;
        $data['description'] = setting_item("site_title")." - #".$booking->id;
        $data['service_title'] = $service->title;
        $data['checkoutNormal'] = 0;
        $data['returnUrl'] = $this->getReturnUrl() . '?c=' . $booking->code ;
        $data['cancelUrl'] = $this->getCancelUrl() . '?c=' . $booking->code;
        return $data;
    }

    public function processNormal($payment)
    {
        if (in_array($payment->status, [
            Booking::PAID,
            Booking::COMPLETED,
            Booking::CANCELLED
        ])) {
            throw new Exception(__("Payment status does need to be paid"));
        }
        $redirect_url = route('checkoutNormalFlutterWaveGateway',['order_id'=>$payment->code]);
        return [true,'',$redirect_url];
    }

    public function cancelPayment(Request $request)
    {
        $c = $request->query('c');
        $booking = Booking::where('code', $c)->first();
        if (!empty($booking) and in_array($booking->status, [$booking::UNPAID])) {
            $payment = $booking->payment;
            if ($payment) {
                $payment->status = 'cancel';
                $payment->logs = \GuzzleHttp\json_encode([
                    'customer_cancel' => 1
                ]);
                $payment->save();
            }
            return redirect($booking->getDetailUrl())->with("error", __("You cancelled the payment"));
        }
        if (!empty($booking)) {
            return redirect($booking->getDetailUrl());
        } else {
            return redirect(url('/'));
        }
    }

    public function confirmPayment(Request $request){
        $c = $request->query('code');
        if(!empty($request->checkoutNormal)){
            return $this->confirmNormalPayment();
        }
        $booking = Booking::where('code', $c)->first();
        if(empty($booking)){
            if($request->ajax()){
                return response()->json(['status'=>0,'message'=>'','url_redirect'=>url('/')]);
            }
            return redirect(url('/'));
        }
        if (in_array($booking->status, [$booking::UNPAID])) {
            if ($request->query('status') =='successful') {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'completed';
                    $payment->logs = \GuzzleHttp\json_encode($request->all());
                    $payment->save();
                }
                try{
                    $booking->paid +=$booking->pay_now;
                    $booking->markAsPaid();
                } catch(\Swift_TransportException $e){
                    Log::warning($e->getMessage());
                }
                if($request->ajax()){
                    return response()->json(['status'=>1,'message'=>'You payment has been processed successfully','url_redirect'=>$booking->getDetailUrl()]);
                }
                return redirect($booking->getDetailUrl())->with("success", __("You payment has been processed successfully"));
            } else {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'fail';
                    $payment->logs = \GuzzleHttp\json_encode($request->all());
                    $payment->save();
                }
                try{
                    $booking->markAsPaymentFailed();
                } catch(\Swift_TransportException $e){
                    Log::warning($e->getMessage());
                }
                if($request->ajax()){
                    return response()->json(['status'=>0,'message'=>'You payment Failed','url_redirect'=>$booking->getDetailUrl()]);
                }
                return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
            }
        }

        if($request->ajax()){
            return response()->json(['status'=>1,'message'=>'','url_redirect'=>$booking->getDetailUrl()]);
        }
        return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
    }


    public function confirmNormalPayment()
    {
        $request = \request();
        $c = $request->query('code');

        $payment = Payment::where('code', $c)->first();
        if (!empty($payment) and in_array($payment->status,['draft'])) {
            if ($request->query('status') == 'successful') {
                return $payment->markAsCompleted();
            } else {
                return $payment->markAsFailed();
            }
        }
        return [false];
    }

}
