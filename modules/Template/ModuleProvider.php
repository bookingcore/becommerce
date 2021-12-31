<?php
namespace Modules\Template;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        BlockManager::register("text",\Modules\Template\Blocks\Text::class );
        BlockManager::register("call_to_action",\Modules\Template\Blocks\CallToAction::class );
        BlockManager::register("breadcrumb_section",\Modules\Template\Blocks\BreadcrumbSection::class );
        BlockManager::register("brands_list",\Modules\Template\Blocks\BrandsList::class );
        BlockManager::register("gallery",\Modules\Template\Blocks\Gallery::class );
        BlockManager::register("block_counter",\Modules\Template\Blocks\BlockCounter::class );
        BlockManager::register("how_it_work",\Modules\Template\Blocks\HowItWork::class );
        BlockManager::register("testimonial",\Modules\Template\Blocks\Testimonial::class );
        BlockManager::register("faq_list",\Modules\Template\Blocks\FaqList::class );
        BlockManager::register("hero_banner",\Modules\Template\Blocks\HeroBanner::class );
        BlockManager::register("about_block",\Modules\Template\Blocks\AboutBlock::class );
        BlockManager::register("app_download",\Modules\Template\Blocks\AppDownload::class );
        BlockManager::register("table_price",\Modules\Template\Blocks\TablePrice::class );

        BlockManager::register("banner_home_1",\Modules\Template\Blocks\BannerHome1::class );
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
