<?php


namespace Plugins\PaymentMollie;


use Modules\Order\Helpers\PaymentGatewayManager;
use Modules\Plugin\Abstracts\AbstractPluginProvider;
use Plugins\PaymentMollie\Gateway\MollieGateway;

class PluginProvider extends AbstractPluginProvider
{
    public static $name = 'Mollie Gateway';

    public static $author = 'BeCommerce Team';
    public static $desc = 'https://www.mollie.com';

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public function boot(){
        PaymentGatewayManager::register('mollie',MollieGateway::class);
    }
}
