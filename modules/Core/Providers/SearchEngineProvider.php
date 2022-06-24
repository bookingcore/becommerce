<?php


namespace Modules\Core\Providers;


use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\SettingManager;

class SearchEngineProvider extends ServiceProvider
{
    public function boot(Request $request){

        SettingManager::register("search",[$this,'registerSearchSetting']);

        if (strpos($request->path(), 'install') === false && file_exists(storage_path() . '/installed')) {
            $this->initConfigFromDB();
        }
    }


    public function initConfigFromDB(){
        switch ($driver = setting_item('search_driver'))
        {
            case "algolia":
                config()->set('scout.driver',$driver);
                config()->set('scout.algolia.id',setting_item('algolia_app_id'));
                config()->set('scout.algolia.secret',setting_item('algolia_secret'));
                break;
        }
    }

    public function registerSearchSetting(){
        return [
            'title' => __("Search Engine"),
            'view'      => "Core::admin.settings.groups.search",
            'position'=>90,
            "keys"=>[
                'search_driver',
                'algolia_app_id',
                'algolia_secret',
                'algolia_public',
            ]
        ];
    }

}
