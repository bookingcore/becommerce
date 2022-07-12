<?php
namespace Modules\Customer;

use App\User;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Customer\Setting\CustomerSetting;
use Modules\ModuleServiceProvider;
use Modules\Customer\Providers\RouterServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){
        AdminMenuManager::register("customer",[$this,'addAdminMenu']);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        $this->app->register(RouterServiceProvider::class);
        $this->app->register(CustomerSetting::class);

    }


    public function addAdminMenu(){


        $options = [
            "position"=>65,
            'url'        => route('customer.admin.index'),
            'title'      => __('Customers'),
            'icon'     =>'icon ion-ios-contact',
            'permission' => 'customer_view',
            "group"=>"sale",
        ];

        return [
            'customer'=> $options
        ];
    }
}
