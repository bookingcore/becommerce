<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 7/3/2019
 * Time: 9:27 PM
 */
namespace Modules\Page;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\ModuleServiceProvider;
use Modules\Page\Models\Page;
use Modules\Page\Providers\RouterServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('news.php'),
        ]);

        AdminMenuManager::register("page",[$this,'getAdminMenu']);
        AdminMenuManager::register_group('content',__("Content"),30);
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
                "position"=>20,
                'url'        => route('page.admin.index'),
                'title'      => __('Pages'),
                'icon'  => 'icon ion-ios-bookmarks',
                "permission"=>"page_manage",
                "group"=>'content'
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
