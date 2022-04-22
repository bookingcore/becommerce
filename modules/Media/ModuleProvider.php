<?php
namespace Modules\Media;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Media\CustomGcs\GoogleCloudStorageServiceProvider;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        AdminMenuManager::register('media',[$this,'getAdminMenu']);

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(GoogleCloudStorageServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'media'=>[
                'position'=>50,
                'title'=>__("Media"),
                'icon'=>"fa fa-picture-o",
                "url"=>route('media.admin.index'),
                'permission' => 'media_upload',
                "group"=>"content"
            ]
        ];
    }
}
