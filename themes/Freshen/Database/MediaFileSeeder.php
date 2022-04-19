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
        DB::table('media_files')->updateOrInsert(['file_name' => 'freshen-banner-slider-1', 'file_path' => 'freshen/product/banner-slider-1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-banner-slider-1']);
        DB::table('media_files')->updateOrInsert(['file_name' => 'freshen-banner-slider-2', 'file_path' => 'freshen/product/banner-slider-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],['file_name' => 'freshen-banner-slider-2']);

    }
}
