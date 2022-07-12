<?php


namespace Modules\Customer\Setting;


use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SettingManager;

class CustomerSetting extends ServiceProvider
{

    public function boot(){
        SettingManager::register("customer",[$this,'getSettingConfigs']);
    }

    public function getSettingConfigs(){
        return [
            'id'        => 'customer',
            'title'     => __("Customer Settings"),
            'position'  => 50,
            'view'      => "Customer::admin.settings.customer",
            "keys"      => [
                'customer_role',
            ],
            'html_keys' => [

            ]
        ];
    }
}
