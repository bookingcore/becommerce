<?php
namespace Modules\Vendor;

use App\User;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\ModuleServiceProvider;
use Modules\Vendor\Commands\CreatePayoutsCommand;
use Modules\Vendor\Models\VendorRequest;
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
        AdminMenuManager::register("vendor",[$this,'addAdminMenu']);
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
                'vendor_register_captcha',
                'vendor_payout_methods',
                'disable_payout',
                'vendor_product_need_approve'
            ],
            'html_keys' => [

            ]
        ];
    }


    public function addVendorMenu(){
        $items =  [
            'product'=>[
                'url'=>route('vendor.product'),
                'title'=>__("Products"),
                "icon"=>"fa fa-database",
                'position'=>20
            ],
            'order'=>[
                'url'=>route('vendor.order'),
                'title'=>__("Orders"),
                "icon"=>"fa fa-shopping-basket",
                'position'=>30
            ],
            'review'=>[
                'url'=>route('vendor.review'),
                'title'=>__("Reviews"),
                "icon"=>"fa fa-commenting",
                'position'=>40
            ],
            'profile'=>[
                'url'=>route('vendor.profile'),
                'title'=>__("Store Settings"),
                "icon"=>"fa fa-user",
                'position'=>60
            ],
        ];
        if(is_payout_enable()){
            $items['payout'] = [
                'url'=>route('vendor.payout'),
                'title'=>__("Payouts"),
                "icon"=>"fa fa-credit-card",
                'position'=>50
            ];
        }
        return $items;
    }

    public function addAdminMenu(){
        if(!is_vendor_enable()){
            return [];
        }

        $noti_verify = User::countVerifyRequest();
        $noti_upgrade = VendorRequest::where('status', 'pending')->count();
        $noti = $noti_verify + $noti_upgrade;

        $options = [
            "position"=>60,
            'url'        => route('vendor.admin.index'),
            'title'      => __('Vendors :count',['count'=>$noti ? sprintf('<span class="badge badge-warning">%d</span>',$noti) : '']),
            'icon'     =>'icon ion-ios-basket',
            'permission' => 'vendor_view',
            'children'   => [
                'all'=>[
                    'url'   => route('vendor.admin.index'),
                    'title' => __('All Vendors'),
                    'permission' => 'vendor_view',
                ],
                'payout'=>[
                    'url'        => route('vendor.admin.payout.index'),
                    'title'      => __('Payouts'),
                    'permission' => 'vendor_view',
                ],
                'request'=>[
                    'url'        => route('vendor.admin.request'),
                    'title'      => __('Signup Request :count',['count'=>$noti_upgrade ? sprintf('<span class="badge badge-warning">%d</span>',$noti_upgrade) : '']),
                    'permission' => 'vendor_view',
                ],
            ]
        ];

        return [
            'vendor'=> $options
        ];
    }
}
