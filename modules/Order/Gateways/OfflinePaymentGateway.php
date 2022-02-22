<?php


namespace Modules\Order\Gateways;


use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Order\Events\PaymentUpdated;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;

class OfflinePaymentGateway extends BaseGateway
{
    public $name = 'Offline Payment';

    public function process(Payment $payment)
    {
        $order = $payment->order;
        if (!$payment->amount) {
            throw new Exception(__("Order total is zero. Can not process payment gateway!"));
        }
        // Simple change status to processing
        $order->markAsProcessing();
        $payment->status = Order::PROCESSING;
        $payment->save();
        PaymentUpdated::dispatch($payment);
        return true;
    }

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Offline Payment?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("Offline Payment")
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
        ];
    }
}

