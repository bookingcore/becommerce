<?php
namespace Plugins\PaymentPayPalPro;

use Modules\ModuleServiceProvider;
use Modules\Order\Helpers\PaymentGatewayManager;
use Plugins\PaymentPayPalPro\Gateway\PayPalProGateway;

class ModuleProvider extends ModuleServiceProvider
{
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){
        PaymentGatewayManager::register('paypal_pro',PayPalProGateway::class);
    }


    public static function getPluginInfo()
    {
        return [
            'title'   => __('Gateway PayPal Pro'),
            'desc'    => __('Gateway PayPal Pro is one of the best payment Gateway to accept online payments from buyers around the world which allow your customers to make purchases in many payment methods, 15 languages, 87 currencies, and more than 200 markets in the world.'),
            'author'  => "Booking Core",
            'version' => "1.2.0",
        ];
    }
}
