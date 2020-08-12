<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Media\Models\MediaFile;

class News extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('core_settings')->insert(
            [
                [
                    'name' => 'news_page_list_title',
                    'val' => 'News',
                    'group' => "news",
                ],
                [
                    'name' => 'news_page_list_banner',
                    'val' => MediaFile::findMediaByName("news-banner")->id,
                    'group' => "news",
                ],
                [
                    'name' => 'news_sidebar',
                    'val' => '[{"title":null,"content":null,"type":"search_form"},{"title":"About Us","content":"Nam dapibus nisl vitae elit fringilla rutrum. Aenean sollicitudin, erat a elementum rutrum, neque sem pretium metus, quis mollis nisl nunc et massa","type":"content_text"},{"title":"Recent News","content":null,"type":"recent_news"},{"title":"Categories","content":null,"type":"category"},{"title":"Tags","content":null,"type":"tag"}]',
                    'group' => "news",
                ],
            ]
        );

        $list_categories = [
              ['name' => 'Entertaiment', 'slug' => 'entertaiment',  'status' => 'publish' ]
            , ['name' => 'Technology', 'slug' => 'technology',  'status' => 'publish' ]
            , ['name' => 'Life Style ', 'slug' => 'life-style',  'status' => 'publish' ]
            , ['name' => 'Others', 'slug' => 'others',  'status' => 'publish' ]
            , ['name' => 'Business', 'slug' => 'business',  'status' => 'publish' ]
            , ['name' => 'Fashion', 'slug' => 'fashion',  'status' => 'publish' ]
        ];
        foreach ($list_categories as $category){
            $row = new NewsCategory( $category );
            $row->save();
        }
        $list_tags = [
             ['name' => 'Business', 'slug' => 'business' ],
             ['name' => 'Clothings', 'slug' => 'clothings' ],
             ['name' => 'Design', 'slug' => 'design' ],
             ['name' => 'Entertaiment', 'slug' => 'entertaiment' ],
             ['name' => 'Fashion', 'slug' => 'fashion'],
             ['name' => 'Internet', 'slug' => 'internet'],
             ['name' => 'Life Style', 'slug' => 'life-style'],
             ['name' => 'Marketing', 'slug' => 'marketing'],
             ['name' => 'Music', 'slug' => 'music'],
             ['name' => 'New Style', 'slug' => 'new-style'],
             ['name' => 'Print', 'slug' => 'print'],
             ['name' => 'Spring', 'slug' => 'spring'],
             ['name' => 'Summer', 'slug' => 'summer'],
             ['name' => 'Technology', 'slug' => 'technology']
        ];
        foreach ($list_tags as $tag) {
            $row = new Tag($tag);
            $row->save();
        }


        DB::table('core_news')->insert([
            'title' => 'Experience Great Sound With Beats’s Headphone',
            'slug' => Str::slug('Experience Great Sound With Beats’s Headphone', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-1")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Products Necessery For Mom',
            'slug' => Str::slug('Products Necessery For Mom', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-2")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Home Interior: Modern Style 2017',
            'slug' => Str::slug('Home Interior: Modern Style 2017', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-3")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'A New Look About Startup In Product Manufacture Field',
            'slug' => Str::slug('A New Look About Startup In Product Manufacture Field', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-4")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'B&O Play – Best Headphone For You',
            'slug' => Str::slug('B&O Play – Best Headphone For You', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-5")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Unique Products For Your Kitchen From IKEA Design',
            'slug' => Str::slug('Unique Products For Your Kitchen From IKEA Design', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-6")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Explore Fashion Trending For Guys In Autumn 2017',
            'slug' => Str::slug('Explore Fashion Trending For Guys In Autumn 2017', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-7")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Compact & Powerful: Cannon Pentack Beside You Go To Anywhere',
            'slug' => Str::slug('Compact & Powerful: Cannon Pentack Beside You Go To Anywhere', '-'),
            'content' => ' From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception  From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception <br/>From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception<br/>
    From the iconic to the unexpected, the city of San Francisco never ceases to surprise. Kick-start your effortlessly delivered Northern California holiday in the cosmopolitan hills of  The City . Join your Travel Director and fellow travellers for a Welcome Reception at your hotel.Welcome Reception',
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' => MediaFile::findMediaByName("news-8")->id,
            'create_user' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
    }
}
