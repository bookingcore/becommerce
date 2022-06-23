<?php


namespace Modules\Plugin;


use Modules\Core\Helpers\AdminMenuManager;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){
        AdminMenuManager::register('plugin',[$this,'getAdminMenu']);
    }

    public function getAdminMenu(){
        return [
            'plugin'=>[
                "position"=>110,
                'url'        => route('plugin.admin.index'),
                'title'      => __('Plugins'),
                'icon'       => 'icon ion-ios-contract',
                'permission' => 'plugin_manage',
                'group'=>'system',
            ]
        ];
    }
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);

        $this->app->singleton('plugin_manager',function(){
            return $this->app->make(PluginManager::class);
        });

        foreach (\Modules\Plugin\Facades\PluginManager::activePlugins() as $k=>$plugin){
            $this->app->register(\Modules\Plugin\Facades\PluginManager::provider($plugin));
        }
    }
}
