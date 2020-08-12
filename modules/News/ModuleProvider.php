<?php
namespace Modules\News;

use Illuminate\Support\ServiceProvider;
use Modules\ModuleServiceProvider;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;

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

        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'news'=>[
                "position"=>10,
                'url'        => 'admin/module/news',
                'title'      => __("News"),
                'icon'       => 'ion-md-bookmarks',
                'permission' => 'news_view',
                'children'   => [
                    'news_view'=>[
                        'url'        => 'admin/module/news',
                        'title'      => __("All News"),
                        'permission' => 'news_view',
                    ],
                    'news_create'=>[
                        'url'        => 'admin/module/news/create',
                        'title'      => __("Add News"),
                        'permission' => 'news_create',
                    ],
                    'news_categoty'=>[
                        'url'        => 'admin/module/news/category',
                        'title'      => __("Categories"),
                        'permission' => 'news_create',
                    ],
                    'news_tag'=>[
                        'url'        => 'admin/module/news/tag',
                        'title'      => __("Tags"),
                        'permission' => 'news_create',
                    ],
                ]
            ],
        ];
    }

    public static function getTemplateBlocks(){
        return [
            'list_news'=>"\\Modules\\News\\Blocks\\ListNews",
        ];
    }

    public static function getMenuBuilderTypes()
    {
        return [
            'news'=>[
                'class' => News::class,
                'name'  => __("News"),
                'items' => News::searchForMenu(),
                'position'=>10
            ],
            'news_cat'=>
            [
                'class' => NewsCategory::class,
                'name'  => __("News Category"),
                'items' => NewsCategory::searchForMenu(),
                'position'=>11
            ],
        ];
    }
}
