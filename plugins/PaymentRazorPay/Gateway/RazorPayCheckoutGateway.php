<?php
namespace Plugins\PaymentRazorPay\Gateway;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Gateways\BaseGateway;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
class RazorPayCheckoutGateway extends BaseGateway
{
    protected $id   = 'razorpay_gateway';
    public    $name = 'Razorpay Checkout';
    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Razorpay Checkout?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("Razorpay Checkout"),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Custom Logo'),
            ],[
                'type'    => 'select',
                'id'      => 'convert_to',
                'label'   => __('Convert To'),
                'desc'    => __('In case of main currency does not support by RazorPay. You must select currency and input exchange_rate to currency that RazorPay support'),
                'options' => $this->supportedCurrency()
            ],
            [
                'type'       => 'input',
                'input_type' => 'number',
                'id'         => 'exchange_rate',
                'label'      => __('Exchange Rate'),
                'desc'       => __('Example: Main currency is VND (which does not support by RazorPay), you may want to convert it to USD when customer checkout, so the exchange rate must be 23400 (1 USD ~ 23400 VND)'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'input',
                'id'    => 'razorpay_key_id',
                'label' => __('Key ID'),
            ],
            [
                'type'  => 'input',
                'id'    => 'razorpay_key_secret',
                'label' => __('Key Secret'),
            ],
            [
                'type'  => 'checkbox',
                'id'    => 'razorpay_enable_sandbox',
                'label' => __('Enable Sandbox Mode'),
            ],
            [
                'type'       => 'input',
                'id'        => 'razorpay_test_key_id',
                'label'     => __('Test Key ID'),
            ],
            [
                'type'       => 'input',
                'id'        => 'razorpay_test_key_secret',
                'label'     => __('Test Key Secret'),
            ]
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
            throw new Exception(__("Order amount is zero. Can not process payment gateway!"));
        }
	    $keyId = $this->getKeyId();
	    $keySecret = $this->getKeySecret();

        if ($keyId == '' || $keySecret == '')
        {
            return redirect($payment->getDetailUrl())->with("error", __("Payment Failed"));
        }


        $data = $this->handlePurchaseData([
            'amount' => (float)$payment->amount,
            'order_id' => $payment->id,
        ],request(), $payment);

        $payment->status = Order::PROCESSING;
        $payment->save();
        PaymentUpdated::dispatch($payment);
        $orderData = [
            'receipt' => $payment->id."",
            'amount' => (float)$data['amount'] * 100, // 2000 rupees in paise
            'currency' => strtoupper($data['currency']),
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder  = $this->generateRazorPayOrder($orderData,$keyId,$keySecret);

        if($razorpayOrder)
        {
            $razorpayOrder = json_decode($razorpayOrder,true);
            if(isset($razorpayOrder['error']) && !empty($razorpayOrder['error']))
            {
                throw new Exception($razorpayOrder['error']['description']);
            }else{
                $payment->status = Order::ON_HOLD;
                $payment->save();
	            if (isset($razorpayOrder['id']) && !empty($razorpayOrder['id'])) {
		            $queryData = [];
		            $queryData['c'] = $data['cart_order_id'];
		            $queryData['r']= $razorpayOrder['id'];
		            return ['url' => route('checkoutRazorPayGateway',[$queryData['c'],$queryData['r']]) ];
	            } else {
                    throw new Exception(__("Payment Failed!"));
	            }
            }

        }else{
            throw new Exception(__("Payment Failed!"));
        }

    }


    public function confirmRazorPayment($request,$c,$order_id)
    {
        $payment = Payment::find($c);
        if (!empty($payment) ) {
            if(in_array($payment->status, [Order::ON_HOLD])){
                $keyId = $this->getKeyId();
                $keySecret = $this->getKeySecret();
                $orderId = $request->razorpay_order_id;
                $paymentId = $request->razorpay_payment_id;
                $payload = $orderId . '|' . $paymentId;
                $actualSignature = hash_hmac('sha256', $payload, $keySecret);
                if ($actualSignature != $request->razorpay_signature) {
                        $payment->status = Order::FAILED;
                        $payment->logs = \GuzzleHttp\json_encode($request->input());
                        $payment->save();
                        PaymentUpdated::dispatch($payment);
                        redirect($payment->getDetailUrl())->with('error', __("Payment Failed"));
                } else {
                        $payment->status = Order::COMPLETED;
                        $payment->logs = \GuzzleHttp\json_encode($request->input());
                        $payment->save();
                        PaymentUpdated::dispatch($payment);
                    redirect($payment->getDetailUrl())->with('success', __("You payment has been processed successfully"));
                }
            }
        } else {
            return redirect(url('/'));
        }
    }

    public function cancelPayment(Request $request)
    {
        $c = $request->query('c');
        $order = Booking::where('code', $c)->first();

        if (!empty($order) and in_array($order->status, [$Order::ON_HOLD])) {
            $payment = $order->payment;

            if ($payment) {
                $payment->status = 'cancel';
                $payment->logs = \GuzzleHttp\json_encode([
                    'customer_cancel' => 1
                ]);
                $payment->save();
            }
            return redirect($order->getDetailUrl())->with("error", __("You cancelled the payment"));
        }

        if (!empty($order)) {
            return redirect($order->getDetailUrl());
        } else {
            return redirect(url('/'));
        }
    }

    public function handlePurchaseData($data, $request, &$payment = null)
    {
        $main_currency = setting_item('currency_main');
        $supported = $this->supportedCurrency();
        $convert_to = $this->getOption('convert_to');
        if($payment)
        {
            $payment->currency = $main_currency;
            $payment->amount = ((float)$data['amount']);
        }
        $data['currency'] = $main_currency;
        $data['cart_order_id'] = $payment->id;
        $data['amount'] = ((float)$payment->amount * 100);
        $data['description'] = setting_item("site_title")." - #".$payment->id;
        $data['return_url'] = $this->getReturnUrl() . '?pid=' . $payment->id;
        $data['cancel_url'] = $this->getCancelUrl() . '?pid=' . $payment->id;
        $data['currency_code'] = setting_item('currency_main');
        $data['card_holder_name'] = $request->input('first_name') . ' ' . $request->input('last_name');
        $data['street_address'] = $request->input('address') ;
        $data['street_address2'] = $request->input('address2') ;
        $data['city'] = $request->input('city') ;
        $data['state'] = $request->input('state') ;
        $data['country'] = $request->input('country') ;
        $data['zip'] = $request->input('zip') ;
        $data['phone'] = "";
        $data['email'] = $request->input('email') ;
        $data['lang'] = app()->getLocale();
        $supported = array_change_key_case($supported);
        if (!array_key_exists($main_currency, $supported)) {
            if (!$convert_to) {
                throw new Exception(__("RazorPay does not support currency: :name", ['name' => $main_currency]));
            }
            if (!$exchange_rate = $this->getOption('exchange_rate')) {
                throw new Exception(__("Exchange rate to :name must be specific. Please contact site owner", ['name' => $convert_to]));
            }
            if ($payment) {

                $payment->converted_currency = $convert_to;
                $payment->converted_amount = $payment->amount / $exchange_rate;
                $payment->exchange_rate = $exchange_rate;
            }
            $amount = number_format( $payment->amount / $exchange_rate , 2 );
            $data['amount'] = (float)$amount*100;
            $data['currency'] = $convert_to;
        }
        return $data;
    }

    public function getDisplayHtml()
    {
        return $this->getOption('html', '');
    }


    public function supportedCurrency()
    {
        return [
            'INR' => 'Indian rupee',
        ];
    }

    public function generateRazorPayOrder($orderData,$key_id,$keySecret)
    {
        $ch = curl_init();

        $url = 'https://api.razorpay.com/v1/orders';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
        curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $keySecret);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }



	public function getKeyId(){
		$sandBoxEnable = $this->getOption('razorpay_enable_sandbox');
		if ($sandBoxEnable) {
			return  $this->getOption('razorpay_test_key_id');
		} else {
			return  $this->getOption('razorpay_key_id');
		}
	}
	public function getKeySecret(){
		$sandBoxEnable = $this->getOption('razorpay_enable_sandbox');
		if ($sandBoxEnable) {
			return  $this->getOption('razorpay_test_key_secret');
		} else {
			return $this->getOption('razorpay_key_secret');
		}
	}


}
