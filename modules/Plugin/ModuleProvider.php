<?php


namespace Modules\Plugin;


use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function register()
    {
        $this->app->singleton('plugin_manager',function(){
            return $this->app->make(PluginManager::class);
        });

        foreach (\Modules\Plugin\Facades\PluginManager::activePlugins() as $k=>$plugin){
            $this->app->register(\Modules\Plugin\Facades\PluginManager::provider($plugin));
        }
    }
}
