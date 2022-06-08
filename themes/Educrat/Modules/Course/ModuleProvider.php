<?php


namespace Themes\Educrat\Modules\Course;


use Illuminate\Support\ServiceProvider;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Product\Hook;
use Modules\Product\Models\Product;
use Themes\Educrat\Modules\Course\Models\Course;

class ModuleProvider extends ServiceProvider
{

    public function boot(){
        $this->app->bind(Product::class,Course::class);
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadViewsFrom(__DIR__.'/Views','Course');

        //AdminMenuManager::register("");

        add_action(Hook::FORM_BEFORE_PREVIEW_BUTTON,[$this,'showManageLessons']);

        add_filter(Hook::PRODUCT_TYPES,[$this,'hideUnuseProductTypes']);

        add_filter(Hook::PRODUCT_TABS,[$this,'addCourseTabs']);

        add_filter(Hook::SAVING_KEYS,[$this,'addSavingKeys']);
    }

    public function addSavingKeys($keys){
        $keys[] = 'learn';
        $keys[] = 'requirements';

        return $keys;
    }
    public function hideUnuseProductTypes($types){
        return [
            'simple'=>Product::class,
        ];
    }

    public function showManageLessons(Course $course){
        echo view('Course::admin.course.manage_lesson',['row'=>$course]);
    }

    public function addCourseTabs($tabs){

        if(isset($tabs['inventory'])) unset($tabs['inventory']);
        $tabs['course'] = [
            'position'=>30,
            "icon"=>"fa fa-archive",
            "title"=>__("Course Meta"),
            "view"=>"Course::admin.course.info",
            "hide_in_sub_language"=>1
        ];
        return $tabs;
    }
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

}
