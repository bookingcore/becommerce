<?php


namespace Themes\Educrat\Modules\Course\Models;


use Modules\Product\Models\Product;

class Course extends Product
{

    public function sections(){
        return $this->hasMany(Section::class,'course_id');
    }
}
