<?php
namespace Modules\Booking\Gateways;

use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;

class OfflinePaymentGateway extends BaseGateway
{
    public $name = 'Offline Payment';

    public function process(Request $request, $order)
    {
        // Simple change status to processing
        $order->markAsProcessing($this);
        $order->sendNewBookingEmails();
        return response()->json([
            'url' => $order->getDetailUrl()
        ]);
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
