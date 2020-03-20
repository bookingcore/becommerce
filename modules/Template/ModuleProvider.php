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
            'pageBreadcrumbs' =>"\\Modules\\Template\\Blocks\\pageBreadcrumbs",
            'WhySellOnMartfury' =>"\\Modules\\Template\\Blocks\\WhySellOnMartfury",
            'HowItWorks' =>"\\Modules\\Template\\Blocks\\HowItWorks",
            'BestFeesToStart' =>"\\Modules\\Template\\Blocks\\BestFeesToStart",
            'SellerStories' =>"\\Modules\\Template\\Blocks\\SellerStories",
            'FrequentlyAskedQuestions' =>"\\Modules\\Template\\Blocks\\FrequentlyAskedQuestions",
        ];
    }

}
