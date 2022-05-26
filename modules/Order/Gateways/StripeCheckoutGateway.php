<?php


namespace Modules\Order\Gateways;


use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Order\Models\Payment;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Models\Order;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Service\ChargeService;
use Stripe\Stripe;

class StripeCheckoutGateway extends BaseGateway
{
    protected $id = 'stripe_checkout';

    public $name = 'Stripe Checkout';

    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type' => 'checkbox',
                'id' => 'enable',
                'label' => __('Enable Stripe Checkout?')
            ],
            [
                'type' => 'input',
                'id' => 'name',
                'label' => __('Custom Name'),
                'std' => __("Stripe"),
                'multi_lang' => "1"
            ],
            [
                'type' => 'upload',
                'id' => 'logo_id',
                'label' => __('Custom Logo'),
            ],
            [
                'type' => 'editor',
                'id' => 'html',
                'label' => __('Custom HTML Description'),
                'multi_lang' => "1"
            ],
            [
                'type' => 'input',
                'id' => 'stripe_secret_key',
                'label' => __('Secret Key'),
            ],
            [
                'type' => 'input',
                'id' => 'stripe_publishable_key',
                'label' => __('Publishable Key'),
            ],
            [
                'type' => 'checkbox',
                'id' => 'stripe_enable_sandbox',
                'label' => __('Enable Sandbox Mode'),
            ],
            [
                'type' => 'input',
                'id' => 'stripe_test_secret_key',
                'label' => __('Test Secret Key'),
            ],
            [
                'type' => 'input',
                'id' => 'stripe_test_publishable_key',
                'label' => __('Test Publishable Key'),
            ],
            [
                'type' => 'input',
                'readonly'=>1,
                'value'=>route('order.callback',['gateway'=>$this->id]),
                'label' => __('Webhook URL'),
                'desc'=>__("Copy this url and use it for Stripe Webhook Url")
            ],
            [
                'type' => 'input',
                'id' => 'endpoint_secret',
                'label' => __('Endpoint Secret for Webhooks'),
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
        $this->setupStripe();
        $order = $payment->order;
        $items = $order->items;
        $billing = $order->getMetaJson('billing');

        $payment->updateStatus($payment::PENDING);

        $lineItems = [];
        foreach ($items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => setting_item('currency_main'),
                    'product_data' => [
                        'name' => $item->model->title ?? '',
                        'images' => [get_file_url($item->model->image_id ?? '')]
                    ],
                    'unit_amount' => (float)$item->price * 100
                ],
                'quantity' => $item->qty
            ];
        }

        if ($stripe_customer_id = auth()->user()->stripe_customer_id) {
            $stripe_customer_id = $this->tryCreateUser($order);
        }
        $session = \Stripe\Checkout\Session::create([
            'mode' => 'payment',
            'success_url' => $this->getReturnUrl() . '?pid=' . $payment->id . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $this->getCancelUrl() . '?pid=' . $payment->id,
            'customer_email' => $billing['email'] ?? "",
            'line_items' => $lineItems
        ]);
        $payment->addMeta('stripe_session_id', $session->id);
        $payment->save();

        return ['url'=>$session->url ?? $order->getDetailUrl()];
    }

    public function confirmPayment(Request $request)
    {
        $id = $request->query('pid');
        /**
         * @var Payment $payment
         */
        $payment = Payment::find($id);
        $this->setupStripe();
        if (!empty($payment)) {
            $order = $payment->order;
            $session_id = $request->query('session_id');
            if (empty($session_id)) {
                return redirect($order->getDetailUrl());
            }
            if (in_array($payment->status, [Order::UNPAID . Order::ON_HOLD])) {
                $session = \Stripe\Checkout\Session::retrieve($session_id);
                if (empty($session)) {
                    return redirect($order->getDetailUrl());
                }
                if ($session->payment_status == 'paid') {
                    if (empty($stripe_charge_id = $payment->getMeta('stripe_charge_id'))) {
                        $payment->addMeta('stripe_charge_id',$this->getChargeId($session->payment_intent));
                    }

                    $payment->addMeta('stripe_setup_intent', $session->setup_intent);
                    $payment->addMeta('stripe_intent_id', $session->payment_intent);
                    $payment->addMeta('stripe_cs_complete', 1);

                    $payment->logs = $session;
                    $payment->updateStatus($payment::COMPLETED);

                }
            }
            return redirect($order->getDetailUrl());

        } else {
            return redirect(url('/'));
        }
    }


    public function cancelPayment(Request $request)
    {
        $id = $request->query('pid');
        /**
         * @var Payment $payment
         */
        $payment = Payment::find($id);
        if (!empty($payment) ) {
            $oder = $payment->order;
            if (in_array($payment->status, [Order::UNPAID . Order::ON_HOLD])) {
                $payment->logs = [
                    'customer_cancel' => 1
                ];

                $payment->updateStatus($payment::FAILED);
            }
            return redirect($oder->getDetailUrl())->with("error", __("You cancelled the payment"));
        } else {
            return redirect(url('/'));
        }
    }


    public function tryCreateUser(Order $order)
    {
        $billing = $order->getJsonMeta('billing');
        $customer = \Stripe\Customer::create([
            'address' => $billing['address'] ?? "",
            'email' => $billing['email'] ?? "",
            'phone' => $billing['phone'] ?? "",
            'name' => $billing['first_name'] ?? "" . ' ' . $billing['last_name'] ?? "",
        ]);

        $user = auth()->user();
        $user->stripe_customer_id = $customer->id;
        $user->save();
        return $customer->id;

    }


    public function setupStripe()
    {
        \Stripe\Stripe::setApiKey($this->getSecretKey());
    }

    public function getPublicKey()
    {
        if ($this->getOption('stripe_enable_sandbox')) {
            return $this->getOption('stripe_test_publishable_key');
        }
        return $this->getOption('stripe_public_key');
    }

    public function getSecretKey()
    {
        if ($this->getOption('stripe_enable_sandbox')) {
            return $this->getOption('stripe_test_secret_key');
        }
        return $this->getOption('stripe_secret_key');
    }


    public function getDisplayHtml()
    {
        $locale = app()->getLocale();
        if (!empty($locale)) {
            $html = $this->getOption("html_" . $locale);
        }
        if (empty($html)) {
            $html = $this->getOption("html");
        }

        return $html;
    }

    public function callback(Request $request)
    {
        $this->setupStripe();
        $endpoint_secret = $this->getOption('endpoint_secret');
        $event = NULL;
        try {
            $event = \Stripe\Event::constructFrom($request->all());
        } catch (\UnexpectedValueException $e) {
            return response()->json(['message' => __('Webhook error while parsing basic request.')], 400);
            // Invalid payload
        }
        if ($endpoint_secret) {
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            try {
                $event = \Stripe\Webhook::constructEvent(
                    json_encode($request->all()), $sig_header, $endpoint_secret
                );
            } catch (\Stripe\Exception\SignatureVerificationException $e) {
                return response()->json(['message' => __('Webhook error while validating signature.')], 400);
            }
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                /**
                 * @var Payment $payment;
                 */
                $payment = Payment::whereHas('meta', function ($query) use($paymentIntent){
                    $query->where('stripe_intent_id',$paymentIntent->id);
                })->first();
                if (!$payment) {
                    return response()->json(['message' => __('Payment not found')], 400);
                }
                $oder = $payment->order;
                if ($oder) {
                    $oder->paid += (float)$paymentIntent->amount / 100;
                    $oder->markAsPaid();
                    if (!empty($paymentIntent->charges->data)) {
                        $chargeArr= [];
                        foreach ($paymentIntent->charges->data as $charge) {
                            if ($charge['paid'] == true) {
                                $chargeArr[]=  $charge['id'];
                            }
                        }
                        if(!empty($chargeArr)){
                            $payment->addMeta('stripe_charge_id',$chargeArr);
                        }
                    }

                    $payment->logs = $paymentIntent;
                    $payment->updateStatus($payment::COMPLETED);
                }

                break;
            default:
                return response()->json(['message' => __('Received unknown event type')], 400);
        }
    }
    public function getChargeId($paymentIntentId)
    {
        $chargeId = '';
        $this->setupStripe();
        $payment_intent = PaymentIntent::retrieve($paymentIntentId);
        if (!empty($payment_intent->charges->data)) {
            foreach ($payment_intent->charges->data as $charge) {
                if ($charge['paid'] == true) {
                    $chargeId = $charge['id'];
                }
            }
        }
        return $chargeId;
    }


}
