<?php
namespace Themes\Axtronic\Database;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Media\Models\MediaFile;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $media_files = [
            '1'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-1', 'file_path' => 'axtronic/news/news-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-1'])->id,
            '2'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-2', 'file_path' => 'axtronic/news/news-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-2'])->id,
            '3'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-3', 'file_path' => 'axtronic/news/news-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-3'])->id,
            '4'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-4', 'file_path' => 'axtronic/news/news-4.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-4'])->id,
            '5'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-5', 'file_path' => 'axtronic/news/news-5.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-5'])->id,
            '6'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-6', 'file_path' => 'axtronic/news/news-6.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-6'])->id,
            '7'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-6', 'file_path' => 'axtronic/news/news-7.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-7'])->id,
            '8'=> MediaFile::updateOrCreate(['file_name' => 'axtronic-news-6', 'file_path' => 'axtronic/news/news-8.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'axtronic-news-8'])->id,
        ];
        $content = '<p class="fz14 mb25 mt50">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</p>
                    <p class="fz14 mb50">Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
                    <p class="fz14 mt50 mb50">Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis.</p>
                    <div class="mbp_blockquote">
                    <blockquote class="blockquote">
                    <span class="icon">“</span>
                    <h4 class="title">“ Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. ”</h4>
                    </blockquote>
                    </div>
                    <p class="fz14 mb50">Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna. Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus.</p>
                    <p class="mb30 fz14">Duis mattis laoreet neque, et ornare neque sollicitudin at. Proin sagittis dolor sed mi elementum pretium. Donec et justo ante. Vivamus egestas sodales est, eu rhoncus urna semper eu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer tristique elit lobortis purus bibendum, quis dictum metus mattis. Phasellus posuere felis sed eros porttitor mattis. Curabitur massa magna, tempor in blandit id, porta in ligula.</p>
                    <p class="fz14 mb50">Aliquam laoreet nisl massa, at interdum mauris sollicitudin et.Duis mollis et sem sed sollicitudin. Donec non odio neque. Aliquam hendrerit sollicitudin purus, quis rutrum mi accumsan nec. Quisque bibendum orci ac nibh facilisis, at malesuada orci congue. Nullam tempus sollicitudin cursus. Ut et adipiscing erat. Curabitur this is a text link libero tempus congue.</p>';
        DB::table('core_news')->insert([
            'title' => 'The 2017 Wine Lover’s Guide to a Kitchen Remodel',
            'slug' => Str::slug('The 2017 Wine Lover’s Guide to a Kitchen Remodel', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['1'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'We Invite You to These Wonderful Wine Tasting Events',
            'slug' => Str::slug('We Invite You to These Wonderful Wine Tasting Events', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['2'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Spring Wine Festival at a Vintage Vineyard',
            'slug' => Str::slug('Spring Wine Festival at a Vintage Vineyard', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['3'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Tuesday Tips: Being Realistic With Your Goals',
            'slug' => Str::slug('Tuesday Tips: Being Realistic With Your Goals', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['4'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'We Invite You to These Wonderful Wine Tasting Events',
            'slug' => Str::slug('We Invite You to These Wonderful Wine Tasting Events', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['5'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Spring Wine Festival at a Vintage Vineyard',
            'slug' => Str::slug('Spring Wine Festival at a Vintage Vineyard', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['6'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Tuesday Tips: Being Realistic With Your Goals',
            'slug' => Str::slug('Tuesday Tips: Being Realistic With Your Goals', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['7'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
        DB::table('core_news')->insert([
            'title' => 'Spring Wine Festival at a Vintage Vineyard',
            'slug' => Str::slug('Spring Wine Festival at a Vintage Vineyard', '-'),
            'content' => $content,
            'status' => "publish",
            'cat_id' => rand(1, 4),
            'image_id' =>$media_files['8'],
            'create_user' => '1',
            'author_id' => '1',
            'created_at' =>  date("Y-m-d H:i:s")
        ]);
    }
}
