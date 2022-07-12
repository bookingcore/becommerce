<?php


namespace Modules\Location\Settings;


use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SettingManager;

class LocationSetting extends ServiceProvider
{
    public function boot(){
        SettingManager::register('location',[$this,'getSettingsConfig']);
    }

    public function getSettingsConfig(){
        return [
            'id'   => 'location',
            'title' => __("Location Settings"),
            'position'=>31,
            'view'=>"Location::admin.settings.location",
            'keys' => [
                'location_in_header',
                'location_detect',
                'location_inventory_enable',
                'location_default'
            ],
            'html_keys' => [

            ]
        ];
    }
}
