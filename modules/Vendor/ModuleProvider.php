<?php
namespace Modules\Vendor;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;
use Modules\Vendor\Commands\CreatePayoutsCommand;
use Modules\Vendor\Providers\RouterServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('location.php'),
        ]);

        SettingManager::register("vendor",[$this,'getVendorSettings']);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreatePayoutsCommand::class,
            ]);
        }
        VendorMenuManager::register("product",[$this,'addVendorMenu']);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'vendor'
        );
        $this->app->register(RouterServiceProvider::class);

    }

    public static function getTemplateBlocks(){
        return [
            'vendor_register_form'=>"\\Modules\\Vendor\\Blocks\\VendorRegisterForm",
        ];
    }

    public static function getVendorSettings(){
        return [
            'id'        => 'vendor',
            'title'     => __("Vendor Settings"),
            'position'  => 50,
            'view'      => "Vendor::admin.settings.vendor",
            "keys"      => [
                'vendor_enable',
                'vendor_term_condition',
                'vendor_commission_type',
                'vendor_commission_amount',
                'vendor_auto_approved',
                'vendor_role',
                'vendor_register_captcha'
            ],
            'html_keys' => [

            ]
        ];
    }


    public function addVendorMenu(){
        return [
            'product'=>[
                'url'=>route('vendor.product'),
                'title'=>__("Products"),
                "icon"=>"fa fa-database"
            ],
            'order'=>[
                'url'=>route('vendor.order'),
                'title'=>__("Orders"),
                "icon"=>"fa fa-shopping-basket"
            ],
            'payout'=>[
                'url'=>route('vendor.payout'),
                'title'=>__("Payouts"),
                "icon"=>"fa fa-credit-card"
            ]
        ];
    }
}
