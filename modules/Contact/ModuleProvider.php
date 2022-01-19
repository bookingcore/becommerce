<?php
namespace Modules\Contact;

use Modules\Contact\Blocks\Contact;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Template\BlockManager;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper)
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $sitemapHelper->add("contact",[Contact::class,"getForSitemap"]);
        BlockManager::register("contact_block",Contact::class);
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

    public static function getTemplateBlocks(){
        return [
            'contact_block'=>"\\Modules\\Contact\\Blocks\\Contact",
        ];
    }
}
