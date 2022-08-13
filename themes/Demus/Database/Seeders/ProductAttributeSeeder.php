<?php


namespace Themes\Demus\Database\Seeders;


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
        $attr['material'] = DB::table('core_attrs')->insertGetId([
            'name'      =>      'Material',
            'display_type'=>    'text',
            'slug'      =>      'material',
            'service'   =>      'product',
            'create_user'=>     '1',
            'status'=>'publish'
        ]);

        //create term
        $term_list = [
            [
                'name'      =>      'Black',
                'content'   =>      'black',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'black'
            ],
            [
                'name'      =>      'Bisque',
                'content'   =>      'bisque',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'bisque'
            ],
            [
                'name'      =>      'BurlyWood',
                'content'   =>      'burlywood',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'burlywood'
            ],
            [
                'name'      =>      'Chocolate',
                'content'   =>      'chocolate',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'chocolate'
            ],
            [
                'name'      =>      'DarkSeaGreen',
                'content'   =>      'darkseagreen',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'darkseagreen'
            ],
            [
                'name'      =>      'LightBlue',
                'content'   =>      'lightblue',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'lightblue'
            ],
            [
                'name'      =>      'LightSalmon',
                'content'   =>      'lightsalmon',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'lightsalmon'
            ],
            [
                'name'      =>      'NavajoWhite',
                'content'   =>      'navajowhite',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'navajowhite'
            ],
            [
                'name'      =>      'SlateGray',
                'content'   =>      'slategray',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'slategray'
            ],
            [
                'name'      =>      'Tan',
                'content'   =>      'tan',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'tan'
            ],
            [
                'name'      =>      'Wheat',
                'content'   =>      'wheat',
                'attr_id'   =>      $attr['color'],
                'slug'      =>      'wheat'
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
            [
                'name'      =>      'Any',
                'content'   =>      'Any',
                'attr_id'   =>      $attr['material'],
                'slug'      =>      'any'
            ],
            [
                'name'      =>      'Ceramic',
                'content'   =>      'Ceramic',
                'attr_id'   =>      $attr['material'],
                'slug'      =>      'ceramic'
            ],
            [
                'name'      =>      'Fabric',
                'content'   =>      'Fabric',
                'attr_id'   =>      $attr['material'],
                'slug'      =>      'fabric'
            ],
            [
                'name'      =>      'Metal',
                'content'   =>      'Metal',
                'attr_id'   =>      $attr['material'],
                'slug'      =>      'metal'
            ],
            [
                'name'      =>      'Wood',
                'content'   =>      'Wood',
                'attr_id'   =>      $attr['material'],
                'slug'      =>      'wood'
            ],
        ];
        $term = [];
        foreach ($term_list as $k => $list){
            $term[$k] = DB::table('core_terms')->insertGetId($list);
        }
    }

}
