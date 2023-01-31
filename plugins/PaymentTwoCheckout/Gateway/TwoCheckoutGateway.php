<?php
namespace Plugins\PaymentTwoCheckout\Gateway;

use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;
use Modules\Order\Gateways\BaseGateway;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderNote;
class TwoCheckoutGateway extends BaseGateway
{
    protected $id   = 'two_checkout';
    public    $name = 'TwoCheckout Gateway';
    protected $gateway;

    protected $endpoints = 'https://cst.test-gsc.vfims.com';

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable TwoCheckout Gateway?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("TwoCheckout"),
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
                'id'    => 'webhook',
                'label' => __('Webhook url'),
                'readonly'=>true,
                'value'=>$this->getWebhookUrl()
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
        }elseif($client->failed()){
            $response = $client->json();
            throw new \Exception($response['detail']??"Payment Failed!");
        }
        else{
            throw new Exception(__("Payment Failed!"));
        }
    }


    public function confirmPayment(Request $request)
    {
        /**
         * @var Order $order
         */

        $c = $request->input('oid');

        $order = Order::find($c);
        if (!empty($order) ) {
            if($order->isExpired()){
                $order->addNote(OrderNote::ORDER_EXPIRED,__("Payment was success but Order has been expired"));
                $order->updateStatus(Order::FAILED);
                return redirect($order->getDetailUrl())->with("success", __("Payment was success but Order has been expired"));
            }
            if(in_array($order->status, [Order::ON_HOLD])){
                $getPayment = $this->getPayment($order);
                if($getPayment->successful()){
                    $response = $getPayment->json();
                    $status = $response['status'];
                    switch ($status){
                        case 'canceled':
                        case 'expired':
                        case 'failed':
                            $request->merge(['oid'=>$order->id]);
                            $this->cancelPayment($request);
                        break;
                        case 'paid':
                            $order->pay_date = Carbon::now();
                            $order->updateStatus(Order::PROCESSING);
                            return redirect($order->getDetailUrl())->with("success", __("Your order has been processed successfully"));
                        break;
                        default:
                            return redirect($order->getDetailUrl())->with("success", __("Your order has been processed successfully"));
                    }
                }
            }
        } else {
            return redirect(url('/'));
        }
        return redirect($order->getDetailUrl())->with("error", __("Payment Failed"));

    }

    public function cancelPayment(Request $request)
    {
        $oid = $request->input('oid');
        $order = Order::find($oid);
        if (!empty($order) and in_array($order->status, [Order::ON_HOLD])) {
            if ($order) {
                $order->addPaymentLog(['customer_cancel' => 1]);
                $order->updateStatus(Order::CANCELLED);
            }
            if($request->ajax()){
                return response()->json(['status'=>0,'url'=>$order->getDetailUrl(),'message'=>"You cancelled the payment"]);
            }
            return redirect($order->getDetailUrl())->with("error", __("You cancelled the payment"));
        }

        if (!empty($order)) {
            return redirect($order->getDetailUrl());
        } else {
            return redirect(url('/'));
        }
    }


    public function callbackPayment(Request $request)
    {
        $translationId = $request->id;
        $order = Order::where('gateway_transaction_id',$translationId)->first();
        if (!empty($order) ) {
            if($order->isExpired()){
                $order->addNote(OrderNote::ORDER_EXPIRED,__("Payment was success but Order has been expired"));
                $order->updateStatus(Order::FAILED);
                return response()->json(['url'=>$order->getDetailUrl(),'message'=>'Payment was success but Order has been expired']);
            }
            if(in_array($order->status, [Order::ON_HOLD])){
                $getPayment = $this->getPayment($order);
                if($getPayment->successful()){
                    $response = $getPayment->json();
                    $status = $response['status'];
                    switch ($status){
                        case 'canceled':
                        case 'expired':
                        case 'failed':
                            $request->merge(['oid'=>$order->id]);
                            $this->cancelPayment($request);
                        break;
                        case 'paid':
                            $order->pay_date = Carbon::now();
                            $order->updateStatus(Order::PROCESSING);
                            return response()->json(['url'=>$order->getDetailUrl(),'message'=>'Your order has been processed successfully']);
                        break;
                        default:
                            return response()->json(['url'=>$order->getDetailUrl(),'message'=>'Your order has been processed successfully']);
                    }
                }
            }
        } else {
            return response()->json(['url'=>home_url(),'message'=>'Your order not found']);
        }
    }

    public function handlePurchaseData($data, $request, &$order = null)
    {

        $data['amount'] = [
            'value'=>(string)(number_format((float)$order->total, 2, '.', ' ')),
            'currency'=>\Str::upper(setting_item('currency_main'))
        ];
        $data['description'] = setting_item("site_title")." - #".$order->id;
        $data['redirectUrl'] = $this->getReturnUrl() . '?oid=' . $order->id;
        $data['locale'] = app()->getLocale();
        $data['metadata']=[
            'order_id'=>$order->id
        ];
//        $data['profileId'] = $this->getOption('profile_id');
//        $data['testmode'] = $this->getOption("enable_sandbox");
        $data['method'] = "creditcard";
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
