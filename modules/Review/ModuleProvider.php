<?php
namespace Modules\Review;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

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
                "position"=>51,
                'url'        => 'admin/module/review',
                'title'      => __('Reviews'),
                'icon'       => 'icon ion-ios-text',
                'permission' => 'review_manage_others',

            ]
        ];
    }
	public static function getMenuBuilderTypes()
	{
		return [

		];
	}
	public static function getUserMenu()
	{
		return [

		];
	}
}