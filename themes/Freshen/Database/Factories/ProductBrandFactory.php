<?php
namespace Themes\Freshen\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\ProductBrand;

class ProductBrandFactory extends Factory
{
    protected $model = ProductBrand::class;

    public function definition()
    {
        return [
            'name'       => $this->faker->name(),
            'status'     => "publish",
            'create_user'=> "1",
        ];
    }
}
