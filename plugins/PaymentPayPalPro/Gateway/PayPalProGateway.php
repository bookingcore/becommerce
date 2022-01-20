<?php
namespace Plugins\PaymentPayPalPro\Gateway;

use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Booking\Events\BookingCreatedEvent;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Gateways\BaseGateway;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;
use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;
use Validator;
use Illuminate\Support\Facades\Log;

class PayPalProGateway extends BaseGateway
{
    protected $id   = 'paypal_pro';
    public    $name = 'PayPal Pro Checkout';
    protected $gateway;

	public function getOptionsConfigs()
	{
		return [
			[
				'type'  => 'checkbox',
				'id'    => 'enable',
				'label' => __('Enable PayPal Pro?')
			],
			[
				'type'  => 'input',
				'id'    => 'name',
				'label' => __('Custom Name'),
				'std'   => __("Paypal Pro")
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
				'type'  => 'checkbox',
				'id'    => 'test',
				'label' => __('Enable Sandbox Mod?')
			],
			[
				'type'    => 'select',
				'id'      => 'convert_to',
				'label'   => __('Convert To'),
				'desc'    => __('In case of main currency does not support by PayPal. You must select currency and input exchange_rate to currency that PayPal support'),
				'options' => $this->supportedCurrency()
			],
			[
				'type'       => 'input',
				'input_type' => 'number',
				'id'         => 'exchange_rate',
				'label'      => __('Exchange Rate'),
				'desc'       => __('Example: Main currency is VND (which does not support by PayPal), you may want to convert it to USD when customer checkout, so the exchange rate must be 23400 (1 USD ~ 23400 VND)'),
			],
			[
				'type'      => 'input',
				'id'        => 'test_account',
				'label'     => __('Sandbox API Username'),
				'condition' => 'g_paypal_pro_test:is(1)'
			],
			[
				'type'      => 'input',
				'id'        => 'test_client_id',
				'label'     => __('Sandbox API Password'),
				'condition' => 'g_paypal_pro_test:is(1)'
			],
			[
				'type'      => 'input',
				'id'        => 'test_client_secret',
				'label'     => __('Sandbox Signature'),
				'std'       => '',
				'condition' => 'g_paypal_pro_test:is(1)'
			],
			[
				'type'      => 'input',
				'id'        => 'account',
				'label'     => __('API Username'),
				'condition' => 'g_paypal_pro_test:is()'
			],
			[
				'type'      => 'input',
				'id'        => 'client_id',
				'label'     => __('API Password'),
				'condition' => 'g_paypal_pro_test:is()'
			],
			[
				'type'      => 'input',
				'id'        => 'client_secret',
				'label'     => __('Signature'),
				'std'       => '',
				'condition' => 'g_paypal_pro_test:is()'
			],
		];
	}

    public function process(Payment $payment)
    {
        $request = request();
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
	    $rules = [
		    'bravo_paypal_pro_card_name'    => ['required'],
	    ];
	    $messages = [
		    'bravo_paypal_pro_card_name.required'    => __('Card Name is required field'),
	    ];
	    $validator = Validator::make($request->all(), $rules, $messages);
	    if ($validator->fails()) {
		    return response()->json(['errors'   => $validator->errors() ], 200)->send();
	    }

        $payment->status = Order::PROCESSING;
        $payment->save();
        PaymentUpdated::dispatch($payment);

        $this->getGateway();
	    $card = new CreditCard([
		    'firstName' => $request->bravo_paypal_pro_card_name,
		    'number' => $request->bravo_paypal_pro_card_number,
		    'expiryMonth' => $request->bravo_paypal_pro_expiryMonth,
		    'expiryYear' => $request->bravo_paypal_pro_expiryYear,
		    'cvv' => $request->bravo_paypal_pro_cvv,
	    ]);
	    $order = $payment->order;
	    $data = $this->handlePurchaseData([
		    'amount'        => (float)$payment->amount,
		    'card'=>$card,
		    'transactionId' => $payment->id . '.' . time()
	    ],  $payment);
	    $this->gateway->authorize($data);
	    $response = $this->gateway->purchase($data)->send();
	    if ($response->isSuccessful()) {
		    $payment->status = 'completed';
		    $payment->logs = \GuzzleHttp\json_encode($response->getData());
		    $payment->save();
		    PaymentUpdated::dispatch($payment);
            return ['url' => $payment->getDetailUrl()];
	    } else {
		    throw new Exception('Paypal Gateway: ' . $response->getMessage());
	    }
    }
	public function handlePurchaseData($data, &$payment = null)
	{
		$main_currency = setting_item('currency_main');
		$supported = $this->supportedCurrency();
		$convert_to = $this->getOption('convert_to');
		$data['currency'] = $main_currency;
		$data['returnUrl'] = $this->getReturnUrl() . '?pid=' . $payment->id;
		$data['cancelUrl'] = $this->getCancelUrl() . '?pid=' . $payment->id;
		$data['token'] = $payment->id.'.'.uniqid();
		$data['description'] = setting_item("site_title")." - #".$payment->id;
		if (!array_key_exists($main_currency, $supported)) {
			if (!$convert_to) {
				throw new Exception(__("PayPal does not support currency: :name", ['name' => $main_currency]));
			}
			if (!$exchange_rate = $this->getOption('exchange_rate')) {
				throw new Exception(__("Exchange rate to :name must be specific. Please contact site owner", ['name' => $convert_to]));
			}
			if ($payment) {
				$payment->converted_currency = $convert_to;
				$payment->converted_amount = $payment->amount / $exchange_rate;
				$payment->exchange_rate = $exchange_rate;
			}
			$data['amount'] = number_format( $payment->amount / $exchange_rate , 2 );
			$data['currency'] = $convert_to;

			return $data;
		}
		return $data;
	}

	public function supportedCurrency()
	{
		return [
			"aud" => "Australian dollar",
			"brl" => "Brazilian real 2",
			"cad" => "Canadian dollar",
			"czk" => "Czech koruna",
			"dkk" => "Danish krone",
			"eur" => "Euro",
			"hkd" => "Hong Kong dollar",
			"huf" => "Hungarian forint 1",
			"inr" => "Indian rupee 3",
			"ils" => "Israeli new shekel",
			"jpy" => "Japanese yen 1",
			"myr" => "Malaysian ringgit 2",
			"mxn" => "Mexican peso",
			"twd" => "New Taiwan dollar 1",
			"nzd" => "New Zealand dollar",
			"nok" => "Norwegian krone",
			"php" => "Philippine peso",
			"pln" => "Polish złoty",
			"gbp" => "Pound sterling",
			"rub" => "Russian ruble",
			"sgd" => "Singapore dollar ",
			"sek" => "Swedish krona",
			"chf" => "Swiss franc",
			"thb" => "Thai baht",
			"usd" => "United States dollar",
		];
	}

	public function getGateway()
	{
		$this->gateway = Omnipay::create('PayPal_Pro');
		$this->gateway->setUsername($this->getOption('account'));
		$this->gateway->setPassword($this->getOption('client_id'));
		$this->gateway->setSignature($this->getOption('client_secret'));
		$this->gateway->setTestMode(false);
		if ($this->getOption('test')) {
			$this->gateway->setUsername($this->getOption('test_account'));
			$this->gateway->setPassword($this->getOption('test_client_id'));
			$this->gateway->setSignature($this->getOption('test_client_secret'));
			$this->gateway->setTestMode(true);
		}
	}

	public function getDisplayHtml()
	{
		$data = [
			'html' => $this->getOption('html', ''),
		];
		return view("PaymentPayPalPro::frontend.paypal_pro",$data);
	}

}
