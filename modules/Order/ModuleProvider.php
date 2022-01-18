<?php
namespace Modules\Order;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('order.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        AdminMenuManager::register("orders",[$this,'getAdminMenu']);
        SettingManager::register("order",[$this,'getOrderSettings']);
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
            'orders'=>[
                "position"=>45,
                'url'        => route('order.admin.index'),
                'title'      => __("Orders"),
                'icon'       => 'fa fa-dashboard',
                'permission' => 'report_view',
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
}
