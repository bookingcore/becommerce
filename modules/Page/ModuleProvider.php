<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 7/3/2019
 * Time: 9:27 PM
 */
namespace Modules\Page;

use Illuminate\Support\ServiceProvider;
use Modules\ModuleServiceProvider;
use Modules\Page\Models\Page;
use Modules\Page\Providers\RouterServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('news.php'),
        ]);

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'news'
        );

        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'page'=>[
                "position"=>40,
                'url'        => route('page.admin.index'),
                'title'      => __('Pages'),
                'icon'  => 'icon ion-ios-bookmarks',
            ],
        ];
    }

    public static function getMenuBuilderTypes()
    {
        return [
            'page'=>[
                'class' => Page::class,
                'name'  => __("Pages"),
                'items' => Page::searchForMenu(),
                'position'=>20
            ],
        ];
    }
}
