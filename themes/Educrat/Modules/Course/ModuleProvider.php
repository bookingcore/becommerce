<?php


namespace Themes\Educrat\Modules\Course;


use Illuminate\Support\ServiceProvider;
use Modules\Product\Models\Product;
use Themes\Educrat\Modules\Course\Models\Course;

class ModuleProvider extends ServiceProvider
{

    public function boot(){
        $this->app->bind(Product::class,Course::class);
    }

}
