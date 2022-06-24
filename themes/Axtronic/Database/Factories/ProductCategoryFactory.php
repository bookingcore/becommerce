<?php


namespace Themes\Axtronic\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\ProductCategory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;
    public function definition()
    {
        return [
            'name'=>'',
            'image_id'=>'',
            'content'=>'',
            'status'=>'',
        ];
        // TODO: Implement definition() method.
    }
}
