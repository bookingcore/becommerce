<?php
namespace Modules\Order\Gateways;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mockery\Exception;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Models\Payment;
use Modules\Order\Models\Order;
use Omnipay\Omnipay;
use Omnipay\PayPal\ExpressGateway;

class PaypalGateway extends BaseGateway
{
    public $name = 'Paypal Express Checkout';
    /**
     * @var $gateway ExpressGateway
     */
    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type' => 'checkbox',
                'id' => 'enable',
                'label' => __('Enable PayPal?')
            ],
            [
                'type'       => 'input',
                'id'         => 'name',
                'label'      => __('Custom Name'),
                'std'        => __("Paypal"),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Custom Logo'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'checkbox',
                'id'    => 'test',
                'label' => __('Enable Sandbox Mode?')
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
                'condition' => 'g_paypal_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'test_client_id',
                'label'     => __('Sandbox Client Id'),
                'condition' => 'g_paypal_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'test_client_secret',
                'label'     => __('Sandbox Client Secret'),
                'std'       => '',
                'condition' => 'g_paypal_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'account',
                'label'     => __('API Username'),
                'condition' => 'g_paypal_test:is()'
            ],
            [
                'type'      => 'input',
                'id'        => 'client_id',
                'label'     => __('Client Id'),
                'condition' => 'g_paypal_test:is()'
            ],
            [
                'type'      => 'input',
                'id'        => 'client_secret',
                'label'     => __('Client Secret'),
                'std'       => '',
                'condition' => 'g_paypal_test:is()'
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
        $data = $this->handlePurchaseData([
            'amount'        => (float)$payment->amount,
            'reference_id' => $payment->id
        ], $payment);
        $response = $this->createOrder($data);
        $json = $response->json();
        if ($response->successful() and !empty($json['status']) and $json['status'] == 'CREATED') {
            $url  ='';
            foreach ($json['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    $url = $link['href'];
                }
            }
            $payment->status = $payment::ON_HOLD;
            $payment->save();
            PaymentUpdated::dispatch($payment);
            return ['url' => $url];
        } else {
            if (!empty($json['error_description'])) {
                $message = $json['error_description'];
            }
            if (!empty($json['message'])) {
                $message = $json['message'];
            }
            throw new Exception('Paypal Gateway: ' . $message);
        }
    }

    public function confirmPayment(Request $request)
    {
        $pid = $request->query('pid');
        $payment = Payment::find($pid);
        if ($payment) {
            $order = $payment->order;
            $response = $this->captureOrder($request->input('token'));
            $json = $response->json();
            if ($response->successful() and !empty($json['status'])) {
                switch ($json['status']) {
                    case 'COMPLETED';
                        $payment->status = Order::COMPLETED;
                        $payment->logs = \GuzzleHttp\json_encode($json);
                        $payment->save();
                        PaymentUpdated::dispatch($payment);
                        return redirect($payment->getDetailUrl())->with("success", __("You payment has been processed successfully"));
                        break;
                    case 'VOIDED':
                        $payment->status = Order::FAILED;
                        $payment->logs = \GuzzleHttp\json_encode($request->all());
                        $payment->save();
                        PaymentUpdated::dispatch($payment);
                        return redirect($payment->getDetailUrl())->with("error", __("Payment Failed"));
                        break;
                    default:
                        return redirect($payment->getDetailUrl())->with("success", __("You payment is being processed"));
                }
            } else {
                $payment->logs = \GuzzleHttp\json_encode($response->getData());
                $payment->save();
                return redirect($payment->getDetailUrl())->with("error", __("Payment Failed"));
            }
        }
    }

    public function cancelPayment(Request $request)
    {
        $c = $request->query('c');
        $payment = \Modules\Order\Models\Payment::find($c);
        if ($payment) {
            $payment->addMeta('query',$request->query());
            return redirect($payment->getDetailUrl());
        }

    }

    public function callbackPayment(Request $request)
    {
        $event_type = $request->input('event_type');
        try {
            switch ($event_type) {
                case 'CHECKOUT.ORDER.COMPLETED':
                    $purchase_units = $request->input('purchase_units');
                    if (!empty($purchase_units)) {
                        foreach ($purchase_units as $purchase) {
                            $reference_id = $purchase['reference_id'];
                            $payment = Payment::find($reference_id);
                            if (!empty($payment)) {
                                $payment->status = Order::COMPLETED;
                                $payment->logs = \GuzzleHttp\json_encode($request->all());
                                $payment->save();
                                PaymentUpdated::dispatch($payment);
                            }
                        }
                    }
                    break;
            }
            return response()->json(['status'=>1,'message'=>'Success']);

        }catch (\Exception $e){
            return response()->json(['status'=>0,'message'=>$e->getMessage()]);
        }

    }



    public function handlePurchaseData($data, $payment = null)
    {
        $main_currency = setting_item('currency_main');
        $supported = $this->supportedCurrency();
        $convert_to = $this->getOption('convert_to');
        $data['currency'] = $main_currency;
        $data['return_url'] = $this->getReturnUrl() . '?pid=' . $payment->id;
        $data['cancel_url'] = $this->getCancelUrl() . '?pid=' . $payment->id;
        if (!array_key_exists($main_currency, $supported)) {
            if (!$convert_to) {
                throw new Exception(__("PayPal does not support currency: :name", ['name' => $main_currency]));
            }
            if (!$exchange_rate = $this->getOption('exchange_rate')) {
                throw new Exception(__("Exchange rate to :name must be specific. Please contact site owner", ['name' => $convert_to]));
            }
            if ($payment) {
                $payment->converted_currency = $convert_to;
                $payment->converted_amount = $data['amount'] / $exchange_rate;
                $payment->exchange_rate = $exchange_rate;
            }
            $data['originalAmount'] = (float)$data['amount'];
            $data['amount'] = number_format( (float)$data['amount'] / $exchange_rate , 2 );
            $data['currency'] = $convert_to;
        }
        return $data;
    }
    public function createOrder($data = [])
    {
        $accessToken = $this->getAccessToken();
        $this->access_token = $accessToken;
        $params = [
            "intent" => "CAPTURE",
            'purchase_units' => [
                [
                    'reference_id' => $data['reference_id'],
                    'amount' => [
                        "currency_code" => Str::upper($data['currency']),
                        'value' => (string)$data['amount']
                    ]
                ]
            ],
            'application_context' => [
                'return_url' => $data['return_url'],
                'cancel_url' => $data['cancel_url'],
            ],
        ];
        $response = Http::withHeaders(['Accept' => 'application/json', 'content-type' => 'application/json', 'Accept-Language' => 'en_US'])
            ->withToken($accessToken['access_token'])
            ->post($this->getUrl('v2/checkout/orders'), $params);
        return $response;
    }

    public function detailOrder($orderId)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withHeaders(['Accept' => 'application/json', 'content-type' => 'application/json', 'Accept-Language' => 'en_US'])
            ->withToken($accessToken['access_token'])
            ->get($this->getUrl('v2/checkout/orders/' . $orderId));
        return $response;

    }

    public function captureOrder($orderId)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withHeaders(['Accept' => 'application/json', 'content-type' => 'application/json', 'Accept-Language' => 'en_US'])
            ->withToken($accessToken['access_token'])
            ->asForm()
            ->post($this->getUrl('v2/checkout/orders/' . $orderId.'/capture'));
        return $response;

    }


    public function getAccessToken()
    {
        $clientId = $this->getClientId();
        $secret = $this->getClientSecret();
        $response = Http::withHeaders(['Accept' => 'application/json', 'Accept-Language' => 'en_US'])
            ->withBasicAuth($clientId, $secret)
            ->asForm()
            ->post($this->getUrl('v1/oauth2/token'), ['grant_type' => 'client_credentials']);
        $json = $response->json();
        if ($response->successful() and !empty($json['access_token'])) {
            return $json;
        } else {
            if (!empty($json['error_description'])) {
                $message = $json['error_description'];
            }
            if (!empty($json['message'])) {
                $message = $json['message'];
            }
            throw new \Exception($message);
        }
    }

    public function getClientId()
    {
        $clientId = $this->getOption('client_id');
        if ($this->getOption('test')) {
            $clientId = $this->getOption('test_client_id');
        }
        return $clientId;
    }

    public function getClientSecret()
    {
        $secret = $this->getOption('client_secret');
        if ($this->getOption('test')) {
            $secret = $this->getOption('test_client_secret');
        }
        return $secret;
    }

    public function getUrl($path)
    {
        if ($this->getOption('test')) {
            return 'https://api-m.sandbox.paypal.com/' . $path;
        }
        return 'https://api-m.paypal.com/' . $path;
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
}
