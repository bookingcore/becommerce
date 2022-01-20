<?php
namespace Modules\Review;

use Modules\Core\Helpers\AdminMenuManager;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        AdminMenuManager::register("core",[$this,'getAdminMenu']);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'review'=>[
                "position"=>50,
                'url'   => 'admin/module/review',
                'title' => __("Reviews"),
                'icon'  => 'icon ion-ios-text',
                'permission' => 'review_manage_others',
            ],
        ];
    }

}
