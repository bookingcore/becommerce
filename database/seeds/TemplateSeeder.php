<?php

use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $callaction = DB::table('media_files')->insertGetId( ['file_name' => 'templates-1', 'file_path' => 'demo/templates/templates-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']);
        $WhySellOnMartfury = [
            'image-1'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-2', 'file_path' => 'demo/templates/templates-2.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-2'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-3', 'file_path' => 'demo/templates/templates-3.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-3'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-4', 'file_path' => 'demo/templates/templates-4.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-4'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-5', 'file_path' => 'demo/templates/templates-5.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-5'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-6', 'file_path' => 'demo/templates/templates-6.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-6'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-7', 'file_path' => 'demo/templates/templates-7.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-7'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-8', 'file_path' => 'demo/templates/templates-8.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-8'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-9', 'file_path' => 'demo/templates/templates-9.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-9'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-10', 'file_path' => 'demo/templates/templates-10.png', 'file_type' => 'image/png', 'file_extension' => 'png']),
            'image-10'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-11', 'file_path' => 'demo/templates/templates-11.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-11'   =>  DB::table('media_files')->insertGetId( ['file_name' => 'templates-12', 'file_path' => 'demo/templates/templates-12.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];
        $homeImage = [
            'image-1' => DB::table('media_files')->insertGetId( ['file_name' => 'home-1', 'file_path' => 'demo/templates/home-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-2' => DB::table('media_files')->insertGetId( ['file_name' => 'home-2', 'file_path' => 'demo/templates/home-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-3' => DB::table('media_files')->insertGetId( ['file_name' => 'home-3', 'file_path' => 'demo/templates/home-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-4' => DB::table('media_files')->insertGetId( ['file_name' => 'home-4', 'file_path' => 'demo/templates/home-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-5' => DB::table('media_files')->insertGetId( ['file_name' => 'home-5', 'file_path' => 'demo/templates/home-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-6' => DB::table('media_files')->insertGetId( ['file_name' => 'home-6', 'file_path' => 'demo/templates/home-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-7' => DB::table('media_files')->insertGetId( ['file_name' => 'home-7', 'file_path' => 'demo/templates/home-7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-8' => DB::table('media_files')->insertGetId( ['file_name' => 'home-8', 'file_path' => 'demo/templates/home-8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-9' => DB::table('media_files')->insertGetId( ['file_name' => 'home-9', 'file_path' => 'demo/templates/home-9.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
            'image-10' => DB::table('media_files')->insertGetId( ['file_name' => 'home-10', 'file_path' => 'demo/templates/home-10.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg']),
        ];

        DB::table('core_templates')->insert(
            [
                'title' =>  'Become a Vendor',
                'content'   =>  '[{"type":"pageBreadcrumbs","name":"Page Breadcurmbs","model":{"title":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"callaction","name":"Call A Action","model":{"title":"Millions Of Shoppers Can’t Wait To See <br> What You Have In Store","title_button":"Start Selling","link_button":"#","bg":'.$callaction.'},"component":"RegularBlock","open":true,"is_container":false},{"type":"WhySellOnMartfury","name":"Why Sell On Martfury","model":{"title":" WHY SELL ON MARTFURY","content":"Join a marketplace where nearly 50 million buyers around <br> the world shop for unique items","item":[{"_active":true,"title":"Low Fees","sub_title":"It doesn’t take much to list your items <br> and once you make a sale, Martfury’s <br> transaction fee is just 2.5%.","sub_link":"#","icon_image":'.$WhySellOnMartfury['image-1'].',"sub_text":null,"link_title":"Learn More"},{"_active":true,"title":"Powerful Tools","sub_title":"Our tools and services make it easy <br> to manage, promote and grow your <br> business.","sub_link":"#","icon_image":'.$WhySellOnMartfury['image-2'].',"link_title":"Learn More"},{"_active":true,"title":"Support 24/7","sub_title":"Our tools and services make it easy <br> to manage, promote and grow your <br> business.","sub_link":"#","icon_image":'.$WhySellOnMartfury['image-3'].',"link_title":"Learn More"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"HowItWorks","name":"How It Works","model":{"title":"HOW IT WORKS","sub_title":"Easy to start selling online on Martfury just 4 simple steps","list":[{"_active":false,"title":"Register and list your products","content":"<ul>\n<li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>\n<li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>\n</ul>","image":'.$WhySellOnMartfury['image-4'].'},{"_active":true,"title":"Receive orders and sell your product","content":"<ul>\n<li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>\n<li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>\n</ul>","image":'.$WhySellOnMartfury['image-5'].'},{"_active":true,"title":"Package and ship with ease","content":"<ul>\n<li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>\n<li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>\n</ul>","image":'.$WhySellOnMartfury['image-6'].'},{"_active":true,"title":"Get payments and grow your business","content":"<ul>\n<li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>\n<li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>\n</ul>","image":'.$WhySellOnMartfury['image-7'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"BestFeesToStart","name":"Best Fees To Start","model":{"title":"BEST FEES TO START","sub_title":"Affordable, transparent, and secure","sub_content":"It doesn’t cost a thing to list up to 50 items a month, and you only pay after your stuff sells. <br> It’s just a small percent of the money you earn","listPercent":[{"_active":false,"title":"Listing Fee","number":"$0"},{"_active":false,"title":"Final Value Fee","number":"5%"}],"title_list":"Here\'s what you get for your fee:","title_list_content":"<ul>\n<li>A worldwide community of more than 160 million shoppers.</li>\n<li>Shipping labels you can print at home, with big discounts on postage.</li>\n<li>Seller protection and customer support to help you sell your stuff.</li>\n</ul>","payment_content":"We process payments with PayPal, an external payments platform that allows you to process transactions with a variety of payment methods. Funds from PayPal sales on Martfury will be deposited into your PayPal account.","payment_image":'.$WhySellOnMartfury['image-8'].',"title_footer":"Listing fees are billed for 0.20 USD, so if your bank’s currency is not USD, the amount in <br> your currency may vary based on changes in the exchange rate."},"component":"RegularBlock","open":true,"is_container":false},{"type":"SellerStories","name":"Seller Stories","model":{"title":"SELLER STORIES","sub_title":"See Seller share about their successful on Martfury","sliders":[{"_active":false,"avatar":'.$WhySellOnMartfury['image-9'].',"name":"Kanye West","job":"CEO at Google INC","content":"Sed elit quam, iaculis sed semper sit amet udin vitae nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima olatiup.","link":"#","link_title":"PLAY VIDEO"},{"_active":false,"avatar":'.$WhySellOnMartfury['image-10'].',"name":"Anabella Kleva","job":"Managerment at Envato","content":"Sed elit quam, iaculis sed semper sit amet udin vitae nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima olatiup.","link":"#","link_title":"PLAY VIDEO"},{"_active":false,"avatar":'.$WhySellOnMartfury['image-11'].',"name":"Kanye West","job":"CEO at Google INC","content":"Sed elit quam, iaculis sed semper sit amet udin vitae nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima olatiup.","link":"#","link_title":"PLAY VIDEO"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"FrequentlyAskedQuestions","name":"Frequently Asked Questions","model":{"title":"FREQUENTLY ASKED QUESTIONS","sub_title":"Here are some common questions about selling on Martfury","item":"","itemListLeft":[{"_active":false,"title":"How do fees work on Martfury?","content":"<p style=\"box-sizing: border-box; margin-bottom: 1.7em; margin-top: 0px; color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Joining and starting a shop on Martfury is free. There are three basic selling fees: a listing fee, a transaction fee, and a payment processing fee.</p>\n<p style=\"box-sizing: border-box; margin-bottom: 1.7em; margin-top: 0px; color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">It costs USD 0.20 to publish a listing to the marketplace. A listing lasts for four months or until the item is sold. Once an item sells, there is a 3.5% transaction fee on the sale price (not including shipping costs). If you accept payments with PayPal, there is also a payment processing fee based on their fee structure.</p>\n<p style=\"box-sizing: border-box; margin-bottom: 0px; margin-top: 0px; color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Listing fees are billed for $0.20 USD, so if your bank&rsquo;s currency is not USD, the amount may differ based on changes in the exchange rate.</p>"},{"_active":false,"title":"What do I need to do to create a shop?","content":"<p><span style=\"color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">t&rsquo;s easy to set up a shop on Martfury. Create an Martfury account (if you don&rsquo;t already have one), set your shop location and currency, choose a shop name, create a listing, set a payment method (how you want to be paid), and finally set a billing method (how you want to pay your Martfuryfees).</span></p>"}],"itemListRight":[{"_active":false,"title":"How do I get paid?","content":"<p><span style=\"color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">If you accept payments with PayPal, funds from PayPal sales on Martfury will be deposited into your PayPal account. We encourage sellers to use a PayPal Business account and not a Personal account, as personal accounts are subject to monthly receiving limits and cannot accept payments from buyers that are funded by a credit card.</span></p>"},{"_active":false,"title":"Do I need a credit or debit card to create a shop?","content":"<p><span style=\"color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">No, a credit or debit card is not required to create a shop. To be verified as a seller you have the choice to use either a credit card or to register via PayPal. You will not incur any charges until you open your shop and publish your listings.</span></p>"},{"_active":false,"title":"What can I sell on Martfury?","content":"<p><span style=\"color: #666666; font-family: \'Work Sans\', Arial, sans-serif; font-size: 16px; background-color: #ffffff;\">Martfury provides a marketplace for crafters, artists and collectors to sell their handmade creations, vintage goods (at least 20 years old), and both handmade and non-handmade crafting supplies.</span></p>"}],"contact_title":"Still have more questions? Feel free to contact us.","contact_link":"#","contact_link_button":"Contact Us"},"component":"RegularBlock","open":true,"is_container":false},{"type":"callaction","name":"Call A Action","model":{"title":"It\'s time to start making money.","title_button":"Start Selling","link_button":"#","bg":'.$callaction.'},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );

        DB::table('core_templates')->insert(
            [
                'title' =>  'Home Page',
                'content'   =>  '[{"type":"BannerHome1","name":"Banner Home 1","model":{"sliders":[{"_active":false,"image":'.$homeImage['image-1'].'},{"_active":false,"image":'.$homeImage['image-2'].'},{"_active":false,"image":'.$homeImage['image-3'].'}],"saleOff":[{"_active":true,"title":"Unio<br> Leather<br> Bags","number":"20%","image":'.$homeImage['image-4'].',"link":"#","sub_title":"100% leather <br> handmade"},{"_active":true,"title":"iPhone 6+<br> 32Gb","number":"40%","image":'.$homeImage['image-5'].',"link":"#","sub_title":"Experience with<br> best smartphone<br> on the world"}],"banner_big_title":"","banner_big_desc":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"HomeFee","name":"Home Fee","model":{"feeItem":[{"_active":false,"title":"Free Delivery","sub_title":"For all oders over $99","icon":"icon-rocket"},{"_active":false,"title":"90 Days Return","sub_title":"If goods have problems","icon":"icon-sync"},{"_active":false,"title":"Secure Payment","sub_title":"100% secure payment","icon":"icon-credit-card"},{"_active":true,"title":"24/7 Support","sub_title":"Dedicated support","icon":"icon-bubbles"},{"_active":true,"title":"Gift Service","sub_title":"Support gift service","icon":"icon-gift"}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"ListProduct","name":"Product: List Items","model":{"title":"Deals of the day","desc":"","number":10,"style":"","location_id":"","order":"title","order_by":"asc","is_featured":false,"link":"xxx","link_product":"#","style_list":"1","category_id":[]},"component":"RegularBlock","open":true,"is_container":false},{"type":"Promotion","name":"Promotion","model":{"colItem":"4","item":[{"_active":true,"title":"<strong>Acher Fluence</strong> Minimal<br> Speaker","sub_title":"","price":"298.60","sale_price":"157.99","discount":null,"image":'.$homeImage['image-6'].'},{"_active":true,"title":"WOODEN<br> MINIMALISTIC<br> CHAIRS","sub_title":"","price":null,"sale_price":null,"discount":40,"image":'.$homeImage['image-7'].',"link":""},{"_active":true,"title":"<strong>iQOS 2.4</strong><br> Holder &amp;<br> Charger","sub_title":"","price":"105.50","sale_price":"","discount":null,"image":'.$homeImage['image-8'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"ListCategories","name":"Categories: List Items","model":{"title":"Top Categories Of The Month","link_category":"","order":"","order_by":"asc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"ListProductInCategories","name":"Product: List Items In Categories","model":{"title":"Consumer Electronics","category_id":[],"number":10,"order":"","order_by":"asc"},"component":"RegularBlock","open":true,"is_container":false},{"type":"ListProductInCategories","name":"Product: List Items In Categories","model":{"title":"Apparels & Clothings","category_id":[],"number":10,"order":"","order_by":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"ListProductInCategories","name":"Product: List Items In Categories","model":{"title":"Home, Garden & Kitchen","category_id":"","number":10,"order":"","order_by":""},"component":"RegularBlock","open":true,"is_container":false},{"type":"Promotion","name":"Promotion","model":{"colItem":"big_and_small","item":[{"_active":true,"title":"FABRIC BED","price":"260.50","sale_price":"219.05","discount":"25","link":"#","desc":"Strong mattress support with 10 wood<br> prevents sagging and increases mattress","image":'.$homeImage['image-9'].'},{"_active":false,"title":"<strong>iPhone X 128GB</strong><br> Retina Display","price":null,"sale_price":null,"discount":"25","link":"#","desc":null,"image":'.$homeImage['image-10'].'}]},"component":"RegularBlock","open":true,"is_container":false},{"type":"ListProduct","name":"Product: List Items","model":{"style_list":"2","title":"Hot New Arrivals","number":8,"link_product":"#","order":"id","order_by":"desc","is_featured":"","category_id":[]},"component":"RegularBlock","open":true,"is_container":false}]',
                'create_user' => '1',
                'created_at' =>  date("Y-m-d H:i:s")
            ]
        );
    }
}
