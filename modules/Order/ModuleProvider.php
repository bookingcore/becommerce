<?php
namespace Modules\Order;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;
use Modules\Order\Gateways\OfflinePaymentGateway;
use Modules\Order\Gateways\PaypalGateway;
use Modules\Order\Gateways\StripeCheckoutGateway;
use Modules\Order\Helpers\PaymentGatewayManager;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('order.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        AdminMenuManager::register("orders",[$this,'getAdminMenu']);
        AdminMenuManager::register_group('sale',__("Sales"),20);

        SettingManager::register("order",[$this,'getOrderSettings']);
        SettingManager::register("payment",[$this,'getPaymentSettings']);

        PaymentGatewayManager::register('offline',OfflinePaymentGateway::class);
        PaymentGatewayManager::register('paypal',PaypalGateway::class);
        PaymentGatewayManager::register('stripe',StripeCheckoutGateway::class);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'order'
        );
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }
    public static function getAdminMenu()
    {
        return [
            'order'=>[
                "position"=>45,
                'url'        => route('order.admin.index'),
                'title'      => __("Orders"),
                'icon'       => 'fa fa-dashboard',
                'permission' => 'report_view',
                'group'=>'sale'
            ]
        ];
    }

    public function getOrderSettings()
    {
        return [
            'id'   => 'order',
            'title' => __("Order Settings"),
            'position'=>40,
            'view'=>"Order::admin.settings.order",
            "keys"=>[
                'order_enable_recaptcha',
                'order_term_conditions',
                'logo_invoice_id',
                'invoice_company_info',
                'booking_guest_checkout',
                'booking_why_book_with_us'
            ],
            'html_keys'=>[

            ],
            'filter_demo_mode'=>[
                'order_term_conditions',
                'invoice_company_info',
            ]
        ];
    }

    public function getPaymentSettings(){
        $keys = [
            'currency_main',
            'currency_format',
            'currency_decimal',
            'currency_thousand',
            'currency_no_decimal',
            'extra_currency'
        ];

        $gateways = PaymentGatewayManager::all();
        foreach ($gateways as $k=>$gateway){
            $options = $gateway->getOptionsConfigs();
            if (!empty($options)) {
                foreach ($options as $option) {
                    $keys[] = 'g_' . $k . '_' . $option['id'];
                    if( !empty($option['multi_lang']) && !empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')){
                        foreach($languages as $language){
                            if( setting_item('site_locale') == $language->locale) continue;
                            $keys[] = 'g_' . $k . '_' . $option['id'].'_'.$language->locale;
                        }
                    }
                    if ($option['type'] == 'textarea' && $option['type'] == 'editor') {
                        $htmlKeys[] = 'g_' . $k . '_' . $option['id'];
                    }
                }
            }
        }
        return [
            'id'   => 'payment',
            'title' => __("Payment Settings"),
            'position'=>40,
            'view'=>"Order::admin.settings.payment",
            "keys"=>$keys,
            'html_keys'=>[

            ],
            'filter_demo_mode'=>[
            ]
        ];
    }
}
