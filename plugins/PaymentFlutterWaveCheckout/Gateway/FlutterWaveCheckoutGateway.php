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

    public function process(Order $order)
    {
        if (in_array($order->status, [
            Order::PAID,
            Order::COMPLETED,
            Order::PROCESSING,
            Order::CANCELLED
        ])) {
            throw new Exception(__("Order status does need to be paid"));
        }
        if (!$order->total) {
            throw new Exception(__("Order total is zero. Can not process payment gateway!"));
        }
        $order->updateStatus(Order::ON_HOLD);

        return ['url'=>route('checkoutFlutterWaveGateway',['order_id'=>$order->id])];
    }

    public function handlePurchaseData($data, $order)
    {
        $data['public_key']= $this->getOption('flutter_wave_api_key');
        $data['amount'] = ((float)$order->total);
        $data['currency'] = setting_item('currency_main');
        $data['tx_ref'] = $order->id;
        $data['description'] = setting_item("site_title")." - #".$order->id;
        $data['service_title'] = setting_item("site_title")." - #".$order->id;
        $data['checkoutNormal'] = 0;
        $data['returnUrl'] = $this->getReturnUrl() . '?oid=' . $order->id ;
        $data['cancelUrl'] = $this->getCancelUrl() . '?oid=' . $order->id;
        return $data;
    }


    public function cancelPayment(Request $request)
    {
        $oid = $request->query('oid');
        $order = Order::find($oid);
        if (!empty($order)) {
            if(in_array($order->status, [Order::UNPAID,Order::ON_HOLD,Order::PROCESSING])){
                $order->updateStatus(Order::CANCELLED);
                $order->addPaymentLog([
                    'customer_cancel' => 1
                ]);
                return redirect($order->getDetailUrl())->with("error", __("You cancelled the payment"));
            }else{
                return redirect($order->getDetailUrl());
            }
        }else {
            return redirect(url('/'));
        }
    }

    public function confirmPayment(Request $request){
        $oid = $request->query('oid');
        $order = Order::find($oid);
        if(empty($order)){
            if($request->ajax()){
                return response()->json(['status'=>0,'message'=>'','url_redirect'=>url('/')]);
            }
            return redirect(url('/'));
        }
        if (in_array($order->status, [Order::UNPAID,Order::ON_HOLD])) {
            if ($request->query('status') =='successful') {
                $order->addPaymentLog($request->all());
                $order->paid = $order->total;
                $order->updateStatus(Order::PROCESSING);

                if($request->ajax()){
                    return response()->json(['status'=>1,'message'=>'You payment has been processed successfully','url_redirect'=>$order->getDetailUrl()]);
                }
                return redirect($order->getDetailUrl())->with("success", __("You payment has been processed successfully"));
            } else {
                $order->addPaymentLog($request->all());
                $order->updateStatus(Order::FAILED);

                if($request->ajax()){
                    return response()->json(['status'=>0,'message'=>'You payment Failed','url_redirect'=>$order->getDetailUrl()]);
                }
                return redirect($order->getDetailUrl())->with("error", __("Payment Failed"));
            }
        }

        if($request->ajax()){
            return response()->json(['status'=>1,'message'=>'','url_redirect'=>$order->getDetailUrl()]);
        }
        return redirect($order->getDetailUrl())->with("error", __("Payment Failed"));
    }


}
