<?php
namespace Themes\Axtronic\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductTag;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $origin_price = ['30','50','70','80','100','150'][rand(0,5)];
        $price = $origin_price - ['10','5','15','20','25'][rand(0,4)];
        return [
            'title'       => $this->faker->words(10,true),
            'content'     => '<div class="mbp_first">
                          <p class="mb25">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>
                          <div class="ui_page_heading">
                            <ul class="order_list list-style-type-bullet list-inline-item">
                              <li><a href="#">Nunc nec porttitor turpis. In eu risus enim. In vitae mollis elit.</a></li>
                              <li><a href="#">Vivamus finibus vel mauris ut vehicula.</a></li>
                              <li><a href="#">Nullam a magna porttitor, dictum risus nec, faucibus sapien.</a></li>
                            </ul>
                          </div>
                          <p class="mt10">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>
                        </div>',
            'image_id'    => '',
            'short_desc'  => 'Feugiat malesuada a a elit varius diam hac ad penatibus tellus vivamus suscipit duis suspendisse diam ac adipiscing mauris a lorem parturient ac viverra odio et etiam nisi.',
            'brand_id'    => '',
            'gallery'     => '',
            'price'         =>$price,
            'origin_price'  => rand(1,2) == 1 ? $origin_price : "",
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> ['simple','variable'][rand(0,1)],
            'create_user' => '1',
            'author_id'   =>1,
            'attributes_for_variation' => ['1','2'],
            'sku' => "OG1203".rand(1,100),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product){
            $terms = ['1','2','5','6',rand(3,4),rand(7,8)];
            $product->categorySeeder()->attach(ProductCategory::inRandomOrder()->take(random_int(1,3))->pluck('id'));
            $product->termSeeder()->attach($terms);
            $product->tagsSeeder()->attach(ProductTag::inRandomOrder()->take(random_int(1,3))->pluck('id'));
            $product->review()->createMany(
               [
                   [
                       'object_model'         =>  $product->type,
                       'title'         =>  'I love it',
                       'content'       =>  'Love this shirt! The ninja near and dear to my heart. <3',
                       'rate_number'   =>  '5',
                       'author_ip'     =>  '127.0.0.1',
                       'status'        =>  'approved',
                       'create_user'   =>  1,
                       'author_id'     =>  1,
                       'update_user'   =>  1,
                       'vendor_id'     =>  1
                   ],
                   [
                       'object_model'         =>  $product->type,
                       'title'         =>  'This great',
                       'content'       =>  'This will go great with my Hoodie that I ordered a few weeks ago.',
                       'rate_number'   =>  '5',
                       'author_ip'     =>  '127.0.0.1',
                       'status'        =>  'approved',
                       'create_user'   =>  1,
                       'author_id'     =>  1,
                       'update_user'   =>  1,
                       'vendor_id'     =>  1
                   ]
               ]
            );
            if ($product->product_type == "variable") {
                for ($i = 0; $i < 3; $i++) {
                    $product->variations()->createMany([
                        [
                            'price'        => ['30', '50', '70', '80', '100', '150'][rand(0, 5)],
                            'stock_status' => 'in',
                            'active'       => '1',
                            'sku'          => 'XS00'.$i,
                        ]
                    ]);
                }
                foreach ($product->variations as $item) {
                    $item->variation_terms()->createMany([
                        [
                            'variation_id' => $item->id,
                            'term_id'      => rand(1, 2),
                            'product_id'   => $product->id,
                        ]
                    ]);
                    $item->variation_terms()->createMany([
                        [
                            'variation_id' => $item->id,
                            'term_id'      => rand(5, 6),
                            'product_id'   => $product->id,
                        ]
                    ]);
                }
            }
            $product->updateMinMaxPrice();
            $product->updateServiceRate();
        });
    }
}
