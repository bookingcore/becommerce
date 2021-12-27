<?php
namespace Modules\Booking;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        SettingManager::register("booking",[$this,'getBookingSetting']);
        SettingManager::register("payment",[$this,'getPaymentSetting']);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->bind('cart', BravoCart::class);
    }

    public static function getAdminMenu()
    {
        return [
            'orders'=>[
                "position"=>40,
                'url'        => route('booking.admin.orders'),
                'title'      => __("Orders"),
                'icon'       => 'fa fa-dashboard',
                'permission' => 'report_view',
            ]
        ];
    }

    public function getPaymentSetting(){
        $keys = [
            'currency_main',
            'currency_format',
            'currency_decimal',
            'currency_thousand',
            'currency_no_decimal'
        ];
        $all = config('booking.payment_gateways');
        if (!empty($all)) {
            foreach ($all as $k => $gateway) {
                if (!class_exists($gateway))
                    continue;
                $obj = new $gateway($k);
                $options = $obj->getOptionsConfigs();
                if (!empty($options)) {
                    foreach ($options as $option) {
                        $keys[] = 'g_' . $k . '_' . $option['id'];
                        if ($option['type'] == 'textarea' && $option['type'] == 'editor') {
                            $htmlKeys[] = 'g_' . $k . '_' . $option['id'];
                        }
                    }
                }
            }
        }

        return [
            'title' => __("Payment Settings"),
            'position'=>60,
            'view'=>"Booking::admin.settings.payment",
            "keys"=>$keys,
            'html_keys'=>[

            ]
        ];
    }

    public function getBookingSetting()
    {
        return [
            'id'   => 'booking',
            'title' => __("Booking Settings"),
            'position'=>40,
            'view'=>"Booking::admin.settings.booking",
            "keys"=>[
                'booking_enable_recaptcha',
                'booking_term_conditions',
                'email_footer',
                'email_header'
            ],
            'html_keys'=>[

            ]
        ];
    }
}
