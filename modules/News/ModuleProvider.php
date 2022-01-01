<?php
namespace Modules\News;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SettingManager;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\News\Models\News;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->publishes([
            __DIR__.'/Config/config.php' => config_path('news.php'),
        ]);
        if(is_installed()){
            $sitemapHelper->add("news",[app()->make(News::class),'getForSitemap']);
        }

        SettingManager::register("news",[$this,'getNewsSettings']);

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
                'permission' => 'news_manage',
                'children'   => [
                    'news_manage'=>[
                        'url'        => 'admin/module/news',
                        'title'      => __("All News"),
                        'permission' => 'news_manage',
                    ],
                    'news_add'=>[
                        'url'        => 'admin/module/news/create',
                        'title'      => __("Add News"),
                        'permission' => 'news_manage',
                    ],
                    'news_categoty'=>[
                        'url'        => 'admin/module/news/category',
                        'title'      => __("Categories"),
                        'permission' => 'news_manage',
                    ],
                    'news_tag'=>[
                        'url'        => 'admin/module/news/tag',
                        'title'      => __("Tags"),
                        'permission' => 'news_manage',
                    ],
                ]
            ],
        ];
    }

    public static function getBookableServices()
    {
        return [
            'news'=>News::class
        ];
    }

    public static function getTemplateBlocks(){
        return [
            'list_news'=>"\\Modules\\News\\Blocks\\ListNews",
        ];
    }

    public function getNewsSettings(){
        return [
            'id'   => 'news',
            'title' => __("News Settings"),
            'position'=>30,
            'view'=>"News::admin.settings.news",
            "keys"=>[
                'news_page_list_title',
                'news_page_list_seo_title',
                'news_page_list_seo_desc',
                'news_page_list_seo_image',
                'news_page_list_seo_share',
                'news_enable_comment',
                'news_comment_approved',
                'news_comment_number_per_page',
            ],
            'html_keys'=>[

            ]
        ];
    }
}
