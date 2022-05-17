<?php
namespace Plugins\PaymentFlutterWaveCheckout;

use Modules\ModuleServiceProvider;
use Modules\Order\Helpers\PaymentGatewayManager;
use Plugins\PaymentFlutterWaveCheckout\Gateway\FlutterWaveCheckoutGateway;

class ModuleProvider extends ModuleServiceProvider
{
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }
    public function boot(){
        PaymentGatewayManager::register('flutter_wave',FlutterWaveCheckoutGateway::class);
    }

    public static function getPluginInfo()
    {
        return [
            'title'   => __('Gateway FlutterWave'),
            'desc'    => __('Welcome to FlutterWave!'),
            'author'  => "Becommerce",
            'version' => "1.0.1",
        ];
    }
}
