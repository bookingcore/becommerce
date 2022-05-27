<?php
namespace Plugins\PaymentTwoCheckout\Gateway;

use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Gateways\BaseGateway;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;
use Validator;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\Booking;

class TwoCheckoutGateway extends BaseGateway
{
    protected $id   = 'two_checkout_gateway';
    public    $name = 'Two Checkout';
    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Two Checkout?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("Two Checkout"),
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
                'id'    => 'twocheckout_account_number',
                'label' => __('Account Number'),
            ],
            [
                'type'  => 'input',
                'id'    => 'twocheckout_secret_word',
                'label' => __('Secret Word'),
            ],
            [
                'type'  => 'checkbox',
                'id'    => 'twocheckout_enable_sandbox',
                'label' => __('Enable Sandbox Mode'),
            ]
        ];
    }

    public function process(Order $order)
    {
        $request = request();
        if (in_array($order->status, [
            Order::PAID,
            Order::COMPLETED,
            Order::PROCESSING,
            Order::CANCELLED
        ])) {

            throw new Exception(__("Order does not need to be paid"));
        }
        if (!$order->total) {
            throw new Exception(__("Order total is zero. Can not process payment gateway!"));
        }

        $data = $this->handlePurchaseData([], $order, $request);

        $order->updateStatus(Order::ON_HOLD);

        $endPointUrl = $this->getEndPointUrl() ;
        $twoco_args = http_build_query($data, '', '&');

        return ['url'=>$endPointUrl . "?" . $twoco_args];
    }

    public function handlePurchaseData($data, $order, $request)
    {
        $twocheckout_args = array();
        $twocheckout_args['sid'] = $this->getOption('twocheckout_account_number');
        $twocheckout_args['paypal_direct'] = 'Y';
        $twocheckout_args['cart_order_id'] = $order->id;
        $twocheckout_args['merchant_order_id'] = $order->id;
        $twocheckout_args['total'] = (float)$order->total;
        $twocheckout_args['return_url'] = $this->getCancelUrl() . '?oid=' . $order->id;
        $twocheckout_args['x_receipt_link_url'] = $this->getReturnUrl() . '?oid=' . $order->id;
        $twocheckout_args['currency_code'] = setting_item('currency_main');
        $twocheckout_args['card_holder_name'] = $request->input("first_name") . ' ' . $request->input("last_name");
        $twocheckout_args['street_address'] = $request->input("address_line_1");
        $twocheckout_args['street_address2'] = $request->input("address_line_1");
        $twocheckout_args['city'] = $request->input("city");
        $twocheckout_args['state'] = $request->input("state");
        $twocheckout_args['country'] = $request->input("country");
        $twocheckout_args['zip'] = $request->input("zip_code");
        $twocheckout_args['phone'] = "";
        $twocheckout_args['email'] = $request->input("email");
        $twocheckout_args['lang'] = app_get_locale();
        return $twocheckout_args;
    }

    public function getDisplayHtml()
    {
        return $this->getOption('html', '');
    }

    public function confirmPayment(Request $request)
    {
        $oid = $request->query('oid');
        $order = Order::find($oid);
        if (!empty($order)) {
            if(in_array($order->status, [Order::ON_HOLD])){
                $compare_string = $this->getOption('twocheckout_secret_word') . $this->getOption('twocheckout_account_number') . $request->input("order_number") . $request->input("total");
                $compare_hash1 = strtoupper(md5($compare_string));
                $compare_hash2 = $request->input("key");
                if ($compare_hash1 != $compare_hash2) {
                    $order->addPaymentLog($request->all());
                    $order->updateStatus(Order::FAILED);

                    return redirect($order->getDetailUrl())->with("error", __("Payment Failed"));
                } else {
                    $order->addPaymentLog($request->all());
                    $order->paid = $order->total;
                    $order->updateStatus(Order::PROCESSING);

                    return redirect($order->getDetailUrl())->with("success", __("You payment has been processed successfully"));
                }
            }else{
                return redirect($order->getDetailUrl(false));
            }

        } else {
            return redirect(url('/'));
        }
    }

    public function cancelPayment(Request $request)
    {
        $oid = $request->query('oid');
        $order = Order::find($oid);
        if (!empty($order) ) {
            if(in_array($order->status, [Order::ON_HOLD])){
                $order->addPaymentLog(['customer_cancel' => 1]);
                $order->updateStatus(Order::FAILED);
                return redirect($order->getDetailUrl())->with("error", __("You cancelled the payment"));
            }
            return redirect($order->getDetailUrl());
        } else {
            return redirect(url('/'));
        }
    }

    public function getEndPointUrl(){
        if ($this->getOption('twocheckout_enable_sandbox')) {
            $checkout_url_sandbox = 'https://sandbox.2checkout.com/checkout/purchase';
        } else {
            $checkout_url_sandbox = 'https://www.2checkout.com/checkout/purchase';
        }
        return $checkout_url_sandbox;
    }
}
