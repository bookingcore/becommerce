<?php
namespace Modules\Product\Listeners;


use App\User;
use Modules\Product\Events\VendorLogPayment;

class VendorLogPaymentListen
{
    public function __construct()
    {
    }


    public function handle(VendorLogPayment $event)
    {
        $booking = $event->booking;
        $vendor = User::find($booking->vendor_id);
        if(!empty($vendor)){
            $plan = $vendor->vendorPlanData;
        }
    }
}
