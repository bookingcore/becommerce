<?php
namespace Themes\Base\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\Term;
use Modules\News\Models\Tag;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductTag;
use Modules\Product\Models\ProductVariation;
use Modules\Review\Models\Review;

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
            'content'     => '<h5>Embodying the Raw, Wayward Spirit of Rock \'N\' Roll</h5>
<p>Embodying the raw, wayward spirit of rock ānā roll, the Kilburn portable active stereo speaker takes the unmistakable look and sound of Marshall, unplugs the chords, and takes the show on the road.</p>
<p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p>
<p>What do you get</p>
<p>Sound of Marshall, unplugs the chords, and takes the show on the road.</p>
<p>Weighing in under 7 pounds, the Kilburn is a lightweight piece of vintage styled engineering. Setting the bar as one of the loudest speakers in its class, the Kilburn is a compact, stout-hearted hero with a well-balanced audio which boasts a clear midrange and extended highs for a sound that is both articulate and pronounced. The analogue knobs allow you to fine tune the controls to your personal preferences while the guitar-influenced leather strap enables easy and stylish travel.</p>
<p>The FM radio is perhaps gone for good, the assumption apparently being that the jury has ruled in favor of streaming over the internet. The IR blaster is another feature due for retirement ā the S6 had it, then the Note5 didnāt, and now with the S7 the trend is clear.</p>
<p>Perfectly Done</p>
<p>Meanwhile, the IP68 water resistance has improved from the S5, allowing submersion of up to five feet for 30 minutes, plus thereās no annoying flap covering the charging port</p>
<ul>
<li>No FM radio (except for T-Mobile units in the US, so far)</li>
<li>No IR blaster</li>
<li>No stereo speakers</li>
</ul>
<p>If youāve taken the phone for a plunge in the bath, youāll need to dry the charging port before plugging in. Samsung hasnāt reinvented the wheel with the design of the Galaxy S7, but it didnāt need to. The Gala S6 was an excellently styled device, and the S7 has managed to improve on that.</p>',
            'image_id'    => '',
            'short_desc'  => '<ul><li>Unrestrained and portable active stereo speaker</li><li>Free from the confines of wires and chords</li><li>20 hours of portable capabilities</li><li>Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li><li>3/4ā³ Dome Tweeters: 2X and 4ā³ Woofer: 1X</li></ul>',
            'brand_id'    => '',
            'gallery'     => '',
            'price'         =>$price,
            'origin_price'  => $origin_price,
            'status'      => 'publish',
            'stock_status'=> 'in',
            'product_type'=> ['simple','variable'][rand(0,1)],
            'create_user' => '1',
            'author_id'   =>1,
            'attributes_for_variation' => ['1','2']
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
