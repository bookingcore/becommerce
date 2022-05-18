<?php
namespace Modules\Media;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Core\Helpers\SettingManager;
use Modules\Media\CustomGcs\GoogleCloudStorageServiceProvider;
use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        AdminMenuManager::register('media',[$this,'getAdminMenu']);
        SettingManager::register("fileSystem",[$this,'registerFileSystemSetting']);


    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        //$this->app->register(GoogleCloudStorageServiceProvider::class);
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
    public function registerFileSystemSetting(){
        return [
            'title' => __("FileSystem Settings"),
            'view'      => "Media::admin.settings.file-system",
            'position'=>85,
            "keys"=>[
                'filesystem_default',
                'filesystem_s3_key',
                'filesystem_s3_secret_access_key',
                'filesystem_s3_region',
                'filesystem_s3_bucket',

                'gcs_project_id',
                'gcs_bucket',
                'gcs_key_file',
            ]
        ];
    }


}
