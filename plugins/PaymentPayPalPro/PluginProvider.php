<?php


namespace Plugins\PaymentPayPalPro;


use Modules\Order\Helpers\PaymentGatewayManager;
use Modules\Plugin\Abstracts\AbstractPluginProvider;
use Plugins\PaymentPayPalPro\Gateway\PayPalProGateway;

class PluginProvider extends AbstractPluginProvider
{
    public static $name = 'Gateway PayPal Pro';

    public static $author = 'BeCommerce Team';

    public static $desc = 'Gateway PayPal Pro is one of the best payment Gateway to accept online payments from buyers around the world which allow your customers to make purchases in many payment methods, 15 languages, 87 currencies, and more than 200 markets in the world.';

    public static $version = '1.2.0';

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){
        PaymentGatewayManager::register('paypal_pro',PayPalProGateway::class);
    }
}
