<?php
namespace Plugins\PaymentMollie\Gateway;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;
use Modules\Order\Gateways\BaseGateway;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderNote;
class MollieGateway extends BaseGateway
{
    protected $id   = 'mollie';
    public    $name = 'Mollie Gateway';
    protected $gateway;

    protected $end_point = 'https://api.mollie.com/v2';

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Mollie Gateway?')
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
            ],

            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'input',
                'id'    => 'api_key',
                'label' => __('Api Key'),
            ],
            [
                'type'  => 'input',
                'id'    => 'partner_id',
                'label' => __('Partner Id'),
            ],
            [
                'type'  => 'input',
                'id'    => 'profile_id',
                'label' => __('Profile Id'),
            ],
            [
                'type'  => 'checkbox',
                'id'    => 'enable_sandbox',
                'label' => __('Enable Sandbox Mode'),
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
            throw new Exception(__("Order amount is zero. Can not process payment gateway!"));
        }


        if ($this->getOption('api_key') == '' || $this->getOption('profile_id') == '')
        {
            return redirect($order->getDetailUrl())->with("error", __("Payment Failed"));
        }

        $client = $this->createPayment($order);

        if($client->successful()){
            $order->updateStatus($order::ON_HOLD);
            $response = $client->json();
            if(!empty($response['_links']['checkout'])){
                $order->gateway_transaction_id = $response['id'];
                $order->save();
                return ['url'=>$response['_links']['checkout']['href']];
            }else{
                throw new Exception(__("Payment Failed!"));
            }
        }else{
            throw new Exception(__("Payment Failed!"));
        }
    }


    public function confirmPayment($request)
    {
        /**
         * @var Order $order
         */

        $c = $request->input('oid');

        $order = Order::find($c);
        if (!empty($order) ) {
            if(in_array($order->status, [Order::ON_HOLD])){

                $orderId = $request->order_id;
                $paymentId = $request->payment_id;
                $payload = $orderId . '|' . $paymentId;
                $actualSignature = hash_hmac('sha256', $payload, $keySecret);
                if ($actualSignature != $request->signature) {

                    $order->addPaymentLog($request->all());
                    $order->updateStatus($order::FAILED);
                    return redirect($order->getDetailUrl())->with('error', __("Payment Failed"));

                } else {
                    $order->addPaymentLog($request->all());
                    $order->paid = $order->total;
                    if($order->isExpired()){
                        $order->addNote(OrderNote::ORDER_EXPIRED,__("Payment was success but Order has been expired"));
                        $order->updateStatus(Order::FAILED);
                        return redirect($order->getDetailUrl())->with("success", __("Payment was success but Order has been expired"));
                    }else{
                        $order->pay_date = Carbon::now();
                        $order->updateStatus(Order::PROCESSING);
                        return redirect($order->getDetailUrl())->with("success", __("Your order has been processed successfully"));
                    }
                }
            }
        } else {
            return redirect(url('/'));
        }
    }

    public function cancelPayment(Request $request)
    {
        $oid = $request->query('oid');
        $order = Order::find($oid);

        if (!empty($order) and in_array($order->status, [Order::ON_HOLD])) {

            if ($order) {
                $order->addPaymentLog(['customer_cancel' => 1]);
                $order->updateStatus(Order::CANCELLED);
            }
            return redirect($order->getDetailUrl())->with("error", __("You cancelled the payment"));
        }

        if (!empty($order)) {
            return redirect($order->getDetailUrl());
        } else {
            return redirect(url('/'));
        }
    }

    public function handlePurchaseData($data, $request, &$order = null)
    {

        if($order)
        {
            $order->total = ((float)$data['amount']);
        }
        $data['cart_order_id'] = $order->id;
        $data['amount'] = [
            'value'=>((float)$order->total * 100),
            'currency'=>setting_item('currency_main')
        ];
        $data['description'] = setting_item("site_title")." - #".$order->id;
        $data['redirectUrl'] = $this->getReturnUrl() . '?oid=' . $order->id;
        $data['cancel_url'] = $this->getCancelUrl() . '?oid=' . $order->id;
        $data['locale'] = app()->getLocale();
        $data['metadata']=[
            'order_id'=>$order->id
        ];
        $data['profileId'] = $this->getOption('profile_id');
        $data['testmode'] = $this->getOption("enable_sandbox");
        return $data;
    }

    public function getDisplayHtml()
    {
        return $this->getOption('html', '');
    }


    public function createPayment($order): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        $params = $this->handlePurchaseData([],request(), $order);
        $url = $this->end_point.'/payments';
        return Http::withToken($this->getOption('api_key'))->post($url,$params);
    }

    public function getPayment($order): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        /**
         * @var Order $order
         */
        $url = $this->end_point.'/payments/'.$order->gateway_transaction_id;
        return Http::withToken($this->getOption('api_key'))->get($url);
    }

}
