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

    public static function getTemplateBlocks(){
        return [
            'text'=>"\\Modules\\Template\\Blocks\\Text",
            'call_to_action'=>"\\Modules\\Template\\Blocks\\CallToAction",
            'breadcrumb_section'=>"\\Modules\\Template\\Blocks\\BreadcrumbSection",
            'brands_list'=>"\\Modules\\Template\\Blocks\\BrandsList",
            'gallery'=>"\\Modules\\Template\\Blocks\\Gallery",
            'BlockCounter'=>"\\Modules\\Template\\Blocks\\BlockCounter",
            'HowItWork'=>"\\Modules\\Template\\Blocks\\HowItWork",
            'testimonial'=>"\\Modules\\Template\\Blocks\\Testimonial",
            'FaqList'=>"\\Modules\\Template\\Blocks\\FaqList",
            'hero_banner'=>"\\Modules\\Template\\Blocks\\HeroBanner",
            'about'=>"\\Modules\\Template\\Blocks\\AboutBlock",
            'app_download'=>"\\Modules\\Template\\Blocks\\AppDownload",
            'table_price'=>"\\Modules\\Template\\Blocks\\TablePrice",
        ];
    }

}
