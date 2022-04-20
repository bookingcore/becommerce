<?php


namespace Themes\Axtronic\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    public function run(){
        //attr
        $attr = [];
        $attr['color'] = DB::table('core_attrs')->insertGetId([
            'name'      =>      'Color',
            'display_type'=>    'color',
            'slug'      =>      'color',
            'service'   =>      'product',
            'create_user'=>     '1',
            'status'=>'publish'
        ]);
        $attr['size'] = DB::table('core_attrs')->insertGetId([
            'name'      =>      'Size',
            'display_type'=>    'text',
            'slug'      =>      'size',
            'service'   =>      'product',
            'create_user'=>     '1',
            'status'=>'publish'
        ]);

        //create term
        $term_list = [
            [
                'name'      =>      'Red',
                'content'   =>      '#FF0000',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'red'
            ],
            [
                'name'      =>      'Black',
                'content'   =>      '#000000',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'black'
            ],
            [
                'name'      =>      'Blue',
                'content'   =>      '#0000FF',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'blue'
            ],
            [
                'name'      =>      'Gray',
                'content'   =>      '#808080',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'gray'
            ],
            [
                'name'      =>      'S',
                'content'   =>      'S',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      's'
            ],
            [
                'name'      =>      'M',
                'content'   =>      'M',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'm'
            ],
            [
                'name'      =>      'L',
                'content'   =>      'L',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'l'
            ],
            [
                'name'      =>      'XL',
                'content'   =>      'XL',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'xl'
            ],
            [
                'name'      =>      'XXL',
                'content'   =>      'XXL',
                'attr_id'   =>      $attr['size'],
                'slug'      =>      'Xl'
            ],
        ];
        $term = [];
        foreach ($term_list as $k => $list){
            $term[$k] = DB::table('core_terms')->insertGetId($list);
        }
    }

}
