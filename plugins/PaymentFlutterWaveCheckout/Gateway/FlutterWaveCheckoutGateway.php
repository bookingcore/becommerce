<?php
namespace Plugins\PaymentFlutterWaveCheckout\Gateway;

use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Booking\Models\Booking;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Gateways\BaseGateway;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;
use Illuminate\Support\Facades\Log;
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

    public function process(Payment $payment)
    {
        if (in_array($payment->status, [
            Order::PAID,
            Order::COMPLETED,
            Order::CANCELLED
        ])) {
            throw new Exception(__("Order status does need to be paid"));
        }
        if (!$payment->amount) {
            throw new Exception(__("Order total is zero. Can not process payment gateway!"));
        }
        $payment->status = Order::PROCESSING;
        $payment->save();
        PaymentUpdated::dispatch($payment);
        return ['url'=>route('checkoutFlutterWaveGateway',['payment_id'=>$payment->code])];
    }

    public function handlePurchaseData($data, $payment)
    {
        $data['public_key']= $this->getOption('flutter_wave_api_key');
        $data['amount'] = ((float)$payment->amount);
        $data['currency'] = setting_item('currency_main');
        $data['tx_ref'] = $payment->id;
        $data['description'] = setting_item("site_title")." - #".$payment->id;
        $data['service_title'] = setting_item("site_title")." - #".$payment->id;
        $data['checkoutNormal'] = 0;
        $data['returnUrl'] = $this->getReturnUrl() . '?pid=' . $payment->id ;
        $data['cancelUrl'] = $this->getCancelUrl() . '?pid=' . $payment->id;
        return $data;
    }


    public function cancelPayment(Request $request)
    {
        $pid = $request->query('pid');
        $payment = Payment::find($pid);
        if (!empty($payment)) {
            if(in_array($payment->status, [Order::UNPAID,Order::ON_HOLD,Order::PROCESSING])){
                $payment->status = Order::CANCELLED;
                $payment->logs = \GuzzleHttp\json_encode([
                    'customer_cancel' => 1
                ]);
                $payment->save();
                return redirect($payment->getDetailUrl())->with("error", __("You cancelled the payment"));
            }else{
                return redirect($payment->getDetailUrl());
            }
        }else {
            return redirect(url('/'));
        }
    }

    public function confirmPayment(Request $request){
        $pid = $request->query('pid');
        $payment = Payment::find($pid);
        if(empty($payment)){
            if($request->ajax()){
                return response()->json(['status'=>0,'message'=>'','url_redirect'=>url('/')]);
            }
            return redirect(url('/'));
        }
        if (in_array($payment->status, [Order::UNPAID,Order::ON_HOLD,Order::PROCESSING])) {
            if ($request->query('status') =='successful') {
                    $payment->status = Order::COMPLETED;
                    $payment->logs = \GuzzleHttp\json_encode($request->all());
                    $payment->save();
                    PaymentUpdated::dispatch($payment);
                if($request->ajax()){
                    return response()->json(['status'=>1,'message'=>'You payment has been processed successfully','url_redirect'=>$payment->getDetailUrl()]);
                }
                return redirect($payment->getDetailUrl())->with("success", __("You payment has been processed successfully"));
            } else {
                    $payment->status =Order::FAILED;
                    $payment->logs = \GuzzleHttp\json_encode($request->all());
                    $payment->save();
                PaymentUpdated::dispatch($payment);
                if($request->ajax()){
                    return response()->json(['status'=>0,'message'=>'You payment Failed','url_redirect'=>$payment->getDetailUrl()]);
                }
                return redirect($payment->getDetailUrl())->with("error", __("Payment Failed"));
            }
        }

        if($request->ajax()){
            return response()->json(['status'=>1,'message'=>'','url_redirect'=>$payment->getDetailUrl()]);
        }
        return redirect($payment->getDetailUrl())->with("error", __("Payment Failed"));
    }


}
