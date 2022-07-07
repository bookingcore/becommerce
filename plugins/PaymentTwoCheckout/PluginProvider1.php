<?php


namespace Plugins\PaymentTwoCheckout;


use Modules\Order\Helpers\PaymentGatewayManager;
use Modules\Plugin\Abstracts\AbstractPluginProvider;
use Plugins\PaymentTwoCheckout\Gateway\TwoCheckoutGateway;

class PluginProvider extends AbstractPluginProvider
{
    public static $name = 'TwoCheckout Gateway';

    public static $author = 'BeCommerce Team';
    public static $desc = 'https://www.2checkout.com';

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){
        PaymentGatewayManager::register('two_checkout',TwoCheckoutGateway::class);
    }
}
