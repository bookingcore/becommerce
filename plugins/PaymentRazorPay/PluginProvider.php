<?php


namespace Plugins\PaymentRazorPay;


use Modules\Order\Helpers\PaymentGatewayManager;
use Modules\Plugin\Abstracts\AbstractPluginProvider;
use Plugins\PaymentRazorPay\Gateway\RazorPayCheckoutGateway;

class PluginProvider extends AbstractPluginProvider
{
    public static $name = 'RazorPay Gateway';

    public static $author = 'BeCommerce Team';

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){
        PaymentGatewayManager::register('razorpay',RazorPayCheckoutGateway::class);
    }
}
