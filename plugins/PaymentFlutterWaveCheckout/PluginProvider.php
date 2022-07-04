<?php


namespace Plugins\PaymentFlutterWaveCheckout;


use Modules\Order\Helpers\PaymentGatewayManager;
use Modules\Plugin\Abstracts\AbstractPluginProvider;
use Plugins\PaymentFlutterWaveCheckout\Gateway\FlutterWaveCheckoutGateway;

class PluginProvider extends AbstractPluginProvider
{
    public static $name = 'Gateway FlutterWave';

    public static $author = 'BeCommerce Team';


    public static $version = '1.0.1';

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }
    public function boot(){
        PaymentGatewayManager::register('flutter_wave',FlutterWaveCheckoutGateway::class);
    }
}
