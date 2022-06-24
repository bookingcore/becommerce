<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $banner_slider_1 = DB::table('media_files')->insertGetId( ['file_name' => 'banner-slider-1', 'file_path' => 'demo/product/banner-slider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']);
        $promotion_1 = DB::table('media_files')->insertGetId( ['file_name' => 'promotion-1', 'file_path' => 'demo/product/promotion-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']);

        DB::table('core_templates')->insert(
            [
                'title' =>  'Home Page',
                'content'   =>  '[{"type":"banner_slider","name":"Banner Slider","model":{"sliders":[{"_active":true,"title":"IKEA Minimalist Otoman","sub_title":"Mega Sale Nov 2021","image":'.$banner_slider_1.',"sub_text":"Discount <strong>50% Off </strong>","btn_shop_now":"Shop Now","link_shop_now":"#"},{"_active":true,"title":"Double Combo With The Body Shop","sub_title":"Mega Sale Nov 2021","image":'.$banner_slider_1.',"sub_text":"Discount <strong>70% Off </strong>","btn_shop_now":"Shop now","link_shop_now":"#"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"featured_icon","name":"Featured Icon","model":{"list_items":[{"_active":true,"title":"Free Delivery","sub_title":"For all oders over $99","icon":"fa fa-rocket"},{"_active":true,"title":"90 Days Return","sub_title":"If goods have problems","icon":"fa fa-reply"},{"_active":true,"title":" 24/7 Support","sub_title":"Dedicated support","icon":"fa fa-comments-o"},{"_active":true,"title":"Secure Payment","sub_title":"100% secure payment","icon":"fa fa-credit-card"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"promotion","name":"Promotion","model":{"col":"3","list_items":[{"_active":true,"image":'.$promotion_1.',"title":"Promotion 1","link":"#"},{"_active":true,"image":'.$promotion_1.',"title":"Promotion 2","link":"#"},{"_active":true,"image":'.$promotion_1.',"link":"#","title":"Promotion 3"},{"_active":true,"title":"Promotion 4","link":"#","image":'.$promotion_1.'}],"title":"Promotion","sub_title":"Recommended for you"},"component":"RegularBlock","open":true,"is_container":false},{"type":"list_product","name":"Product: List item","model":{"style_list":"","title":"Newsest Products","sub_title":"Recommended for you","cat_ids":"","number":8,"order":"id","order_by":"desc","is_featured":""},"component":"RegularBlock","open":true},{"type":"list_product","name":"Product: List item","model":{"style_list":"slide","title":"Top Rated","sub_title":"Recommended for you","cat_ids":"","number":6,"order":"rate","order_by":"desc","is_featured":false},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );

        DB::table('core_templates')->insert(
            [
                'title' =>  'Contact',
                'content'   =>  '[{"type":"contact_block","name":"Contact Block","model":{"class":"","title":"Let\'s get in touch","right_title":"Get in touch","sub_title":"We\'re open for any suggestion or just to have a chat","address":"198 West 21th Street, Suite 721 New York NY 10016","phone":"1234 5678 89","email":"contact@becommerce.test","website":"yoursite.com"},"component":"RegularBlock","open":true}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
    }
}
