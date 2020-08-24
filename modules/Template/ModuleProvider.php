<?php
namespace Modules\Template;
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

    public static function getTemplateBlocks(){
        return [
            'slider'=>"\\Modules\\Template\\Blocks\\Slider",
            'callaction'=>"\\Modules\\Template\\Blocks\\CallAction",
            'WhySellOnMartfury' =>"\\Modules\\Template\\Blocks\\WhySellOnMartfury",
            'HowItWorks' =>"\\Modules\\Template\\Blocks\\HowItWorks",
            'BestFeesToStart' =>"\\Modules\\Template\\Blocks\\BestFeesToStart",
            'SellerStories' =>"\\Modules\\Template\\Blocks\\SellerStories",
            'FrequentlyAskedQuestions' =>"\\Modules\\Template\\Blocks\\FrequentlyAskedQuestions",
            'BannerHome1' =>"\\Modules\\Template\\Blocks\\BannerHome1",
            'BannerHome2' =>"\\Modules\\Template\\Blocks\\BannerHome2",
            'HomeFee' =>"\\Modules\\Template\\Blocks\\HomeFee",
            'Promotion' =>"\\Modules\\Template\\Blocks\\Promotion",
            'BestSellerBrands' =>"\\Modules\\Template\\Blocks\\BestSellerBrands",
            'SearchTrending' =>"\\Modules\\Template\\Blocks\\SearchTrending",
        ];
    }

}
