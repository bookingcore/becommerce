<?php
namespace Database\Seeders;
use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Modules\Theme\ThemeManager;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cache::flush();
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(Language::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MediaFileSeeder::class);
        $this->call(General::class);
        $this->call(News::class);
        $this->call(TemplateSeeder::class);


        $listModule = array_map('basename', File::directories(base_path('modules')));
        $seededClasses = [];
        foreach ($listModule as $module) {
            $class = "\Modules\\".ucfirst($module)."\\Database\\DatabaseSeeder";
            if(class_exists($class) && !in_array($class, $seededClasses)) {
                if (method_exists($class, 'run')) {
                    $this->call($class);
                    $seededClasses[] = $class;
                }
            }
        }

        $provider = ThemeManager::currentProvider();

        if(class_exists($provider))
        {
            $seeder = $provider::$seeder;
            if(class_exists($seeder)){
                $this->call($seeder);
                $provider::updateLastSeederRun();
            }

        }

    }
}
