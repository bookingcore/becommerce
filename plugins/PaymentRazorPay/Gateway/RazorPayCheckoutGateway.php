<?php
namespace Plugins\PaymentRazorPay\Gateway;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Modules\Booking\Models\Payment;
use Razorpay\Api\Api;
use Validator;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\Booking;

class RazorPayCheckoutGateway extends \Modules\Booking\Gateways\BaseGateway
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

    public function process(Request $request, $booking, $service)
    {
        if (in_array($booking->status, [
            $booking::PAID,
            $booking::COMPLETED,
            $booking::CANCELLED
        ])) {
            throw new Exception(__("Booking status does need to be paid"));
        }
        if (!$booking->pay_now) {
            throw new Exception(__("Booking pay now is zero. Can not process payment gateway!"));
        }
	    $keyId = $this->getKeyId();
	    $keySecret = $this->getKeySecret();

        if ($keyId == '' || $keySecret == '')
        {
            return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
        }

        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_gateway = $this->id;
        $payment->status = 'draft';
        $data = $this->handlePurchaseData([
            'amount' => (float)$booking->pay_now,
            'order_id' => $booking->code,
        ], $booking, $service,$payment);
        $payment->save();
        $orderData = [
            'receipt' => $booking->code."",
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
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'fail';
                    $payment->logs = \GuzzleHttp\json_encode($razorpayOrder);
                    $payment->save();
                }
	            throw new Exception($razorpayOrder['error']['description']);
            }else{
	            $booking->status = $booking::UNPAID;
	            $booking->payment_id = $payment->id;
	            $booking->save();
	            if (isset($razorpayOrder['id']) && !empty($razorpayOrder['id'])) {
		            $queryData = [];
		            $queryData['c'] = $data['cart_order_id'];
		            $queryData['r']= $razorpayOrder['id'];
		            return response()->json([
				            'url' => route('checkoutRazorPayGateway',[$queryData['c'],$queryData['r']])
		            ])->send();
	            } else {
		            $payment = $booking->payment;
		            if ($payment) {
			            $payment->status = 'fail';
			            $payment->logs = \GuzzleHttp\json_encode($razorpayOrder);
			            $payment->save();
		            }
		            return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
	            }
            }

        }else{
            return redirect($booking->getDetailUrl())->with("error", __("Payment Failed"));
        }

    }

    public function handlePurchaseData($data, $booking, $request, &$payment = null)
    {
        $main_currency = setting_item('currency_main');
        $supported = $this->supportedCurrency();
        $convert_to = $this->getOption('convert_to');
        if($payment)
        {
            $payment->currency = $main_currency;
            $payment->amount = ((float)$booking->pay_now);
        }
        $data['currency'] = $main_currency;
        $data['cart_order_id'] = $booking->code;
        $data['amount'] = ((float)$booking->pay_now * 100);
        $data['description'] = setting_item("site_title")." - #".$booking->id;
        $data['return_url'] = $this->getReturnUrl() . '?c=' . $booking->code;
        $data['cancel_url'] = $this->getCancelUrl() . '?c=' . $booking->code;
        $data['currency_code'] = setting_item('currency_main');
        $data['card_holder_name'] = $booking->first_name . ' ' . $booking->last_name;
        $data['street_address'] = $booking->address;
        $data['street_address2'] = $booking->address2;
        $data['city'] = $booking->city;
        $data['state'] = $booking->state;
        $data['country'] = $booking->country;
        $data['zip'] = $booking->zip;
        $data['phone'] = "";
        $data['email'] = $booking->email;
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
                $payment->converted_amount = $booking->pay_now / $exchange_rate;
                $payment->exchange_rate = $exchange_rate;
            }
            $amount = number_format( $booking->pay_now / $exchange_rate , 2 );
            $data['amount'] = (float)$amount*100;
            $data['currency'] = $convert_to;
        }
        return $data;
    }
    public function handlePurchaseDataNormal($data, &$payment = null)
    {
    	$author = $payment->author;
        $main_currency = setting_item('currency_main');
        $supported = $this->supportedCurrency();
        $convert_to = $this->getOption('convert_to');
	    $data['currency'] = $main_currency;
	    $data['cart_order_id'] = $payment->code;
	    $data['amount'] = ((float)$payment->amount);
	    $data['description'] = setting_item("site_title")." - #".$payment->id;
	    $data['return_url'] = $payment->getDetailUrl();
	    $data['cancel_url'] = $this->getCancelUrl(true) . '?c=' . $payment->code;
	    $data['currency_code'] = setting_item('currency_main');
	    $data['card_holder_name'] = $author->first_name . ' ' . $author->last_name;
	    $data['street_address'] = $author->address;
	    $data['street_address2'] = $author->address2;
	    $data['city'] = $author->city;
	    $data['state'] = $author->state;
	    $data['country'] = $author->country;
	    $data['zip'] = $author->zip;
	    $data['phone'] = "";
	    $data['email'] = $author->email;
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

    public function confirmRazorPayment($request,$c,$order_id)
    {
        $booking = Booking::where('code', $c)->first();
        if (!empty($booking) and in_array($booking->status, [$booking::UNPAID])) {

            $keyId = $this->getKeyId();
            $keySecret = $this->getKeySecret();

            $orderId = $request->razorpay_order_id;
            $paymentId = $request->razorpay_payment_id;
            $payload = $orderId . '|' . $paymentId;
            $actualSignature = hash_hmac('sha256', $payload, $keySecret);
            if ($actualSignature != $request->razorpay_signature) {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'fail';
                    $payment->logs = \GuzzleHttp\json_encode($request->input());
                    $payment->save();
                }
                try {
                    $booking->markAsPaymentFailed();
                } catch (\Swift_TransportException $e) {
                    Log::warning($e->getMessage());
                }
                Session::flash('error', __("Payment Failed"));
                return $booking->getDetailUrl();
            } else {
                $payment = $booking->payment;
                if ($payment) {
                    $payment->status = 'completed';
                    $payment->logs = \GuzzleHttp\json_encode($request->input());
                    $payment->save();
                }
                try {
                    $booking->paid += (float)$booking->pay_now;
                    $booking->markAsPaid();
                } catch (\Swift_TransportException $e) {
                    Log::warning($e->getMessage());
                }
                Session::flash('success', __("You payment has been processed successfully"));
	            return $booking->getDetailUrl();
            }
        }
        if (!empty($booking)) {
	        return redirect($booking->getDetailUrl(false));
        } else {
	        return redirect(url('/'));
        }
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

	public function processNormal($payment)
	{
		if (in_array($payment->status, [
				Booking::PAID,
				Booking::COMPLETED,
				Booking::CANCELLED
		])) {
			throw new Exception(__("Payment status does need to be paid"));
		}
		if (!$payment->amount) {
			throw new Exception(__("Payment amount is zero. Can not process payment gateway!"));
		}

		$keyId = $this->getKeyId();
		$keySecret = $this->getKeySecret();

		if ($keyId == '' || $keySecret == '')
		{
			return [false];
		}
		$data = $this->handlePurchaseDataNormal([], $payment);
		$payment->save();

		$orderData = [
				'receipt' => $payment->code."",
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
				$payment->markAsFailed($razorpayOrder);
			}else if (isset($razorpayOrder['id']) && !empty($razorpayOrder['id'])) {
				$queryData = [];
				$queryData['c'] = $data['cart_order_id'];
				$queryData['r']= $razorpayOrder['id'];
				$url = route('checkoutRazorPayGateway',['c'=>$queryData['c'],'r'=>$queryData['r'],'is_normal'=>true]);
				return [false,'',$url];

			} else {
				$payment->markAsFailed($razorpayOrder);
			}
		}
		return [false];
	}
	public function confirmRazorPaymentNormal(Request $request,$code,$order_id)
	{
		$payment = Payment::where('code', $code)->first();
		if (!empty($payment) and in_array($payment->status,['draft'])) {
			$keyId = $this->getKeyId();
			$keySecret = $this->getKeySecret();
			$orderId = $request->razorpay_order_id;
			$paymentId = $request->razorpay_payment_id;
			$payload = $orderId . '|' . $paymentId;
			$actualSignature = hash_hmac('sha256', $payload, $keySecret);
			if ($actualSignature != $request->razorpay_signature) {
				$payment->markAsFailed($request->all());
				Session::flash('error', __("Payment Failed"));
				return route('user.wallet');
			} else {
				$payment->markAsCompleted($request->all());
				Session::flash('success', __("You payment has been processed successfully"));
				return route('user.wallet');
			}
		}
		return route('user.wallet');
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
