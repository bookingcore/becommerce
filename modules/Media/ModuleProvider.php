<?php
namespace Modules\Media;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\ModuleServiceProvider;
use Google\Cloud\Storage\StorageClient;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        AdminMenuManager::register('media',[$this,'getAdminMenu']);

        // GCS
        Storage::extend('gcs', function ($app, $config) {

            $options = [
                'projectId'=>setting_item('gcs_project_id')
            ];
            if($file_path = setting_item('gcs_key_file'))
            {
                $options['keyFilePath'] = storage_path('app/gcs/'.$file_path);
            }
            $storageClient = new StorageClient($options);


            $bucket = $storageClient->bucket(setting_item('gcs_bucket'));

            return new GoogleStorageAdapter($storageClient, $bucket);
        });
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
