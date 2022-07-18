<?php
namespace Modules\Location;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Location\Settings\LocationSetting;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(LocationSetting::class);
    }


    public static function getAdminMenu()
    {
        return [
            'location'=>[
                "position"=>40,
                'url'        => route('location.admin.index'),
                'title'      => __("Store Locations"),
                'icon'       => 'icon ion-md-compass',
                'permission' => 'location_manage',
                'group'=>'catalog'
            ]
        ];
    }
}
