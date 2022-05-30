<?php
namespace Themes\Freshen\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    public function run(){
        //attr
        $attr = [];
        $attr['park'] = DB::table('core_attrs')->insertGetId([
            'name'      =>      'Park',
            'display_type'=>    'text',
            'slug'      =>      'park',
            'service'   =>      'product',
            'create_user'=>     '1',
            'status'=>'publish'
        ]);

        //create term
        $term_list = [
            [
                'name'      =>      'Park 10',
                'content'   =>      '',
                'attr_id'   =>      $attr['park'],
                'slug'      =>      '10'
            ],
            [
                'name'      =>      'Park 20',
                'content'   =>      '',
                'attr_id'   =>      $attr['park'],
                'slug'      =>      '20'
            ],
            [
                'name'      =>      'Park 30',
                'content'   =>      '',
                'attr_id'   =>      $attr['park'],
                'slug'      =>      '30'
            ],
            [
                'name'      =>      'Park 40',
                'content'   =>      '',
                'attr_id'   =>      $attr['park'],
                'slug'      =>      '40'
            ],
        ];
        $term = [];
        foreach ($term_list as $k => $list){
            $term[$k] = DB::table('core_terms')->insertGetId($list);
        }
    }

}
