<?php
namespace Modules\Template;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        BlockManager::register("banner_slider",\Modules\Template\Blocks\BannerSlider::class );
        BlockManager::register("featured_icon",\Modules\Template\Blocks\FeaturedIcon::class );
        BlockManager::register("promotion",\Modules\Template\Blocks\Promotion::class );
    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }
}
