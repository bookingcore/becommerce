<?php


namespace Modules\Product\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductTag;

class ProductTagFactory extends Factory
{
    protected $model = ProductTag::class;

    public function definition()
    {
        return [
            'name'       => ucfirst($this->faker->words(2,true)),
            'create_user'=> "1",
        ];
    }
}
