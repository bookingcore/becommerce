<?php
namespace Plugins\PaymentRazorPay;

use Modules\ModuleServiceProvider;
use Modules\Order\Helpers\PaymentGatewayManager;
use Plugins\PaymentRazorPay\Gateway\RazorPayCheckoutGateway;

class ModuleProvider extends ModuleServiceProvider
{
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){
        PaymentGatewayManager::register('razorpay',RazorPayCheckoutGateway::class);
    }

    public static function getPluginInfo()
    {
        return [
            'title'   => __('Gateway RazorPay'),
            'desc'    => __('Razorpay is the only payments solution in India that allows businesses to accept, process and disburse payments with its product suite. It gives you access to all payment modes including credit card, debit card, netbanking, UPI and popular wallets including JioMoney, Mobikwik, Airtel Money, FreeCharge, Ola Money and PayZapp.'),
            'author'  => "Booking Core",
            'version' => "1.0.0",
        ];
    }
}
