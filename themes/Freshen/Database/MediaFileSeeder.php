<?php
namespace Themes\Freshen\Database;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('media_files')->insert([
            ['file_name' => 'banner-search', 'file_path' => 'mytravel/tour/banner-search.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
        ]);*/
        for ($i=1 ; $i <= 16 ; $i++){
            /*DB::table('media_files')->insert([
                ['file_name' => 'tour-'.$i, 'file_path' => 'mytravel/tour/tour-'.$i.'.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ]);*/
        }

    }
}
