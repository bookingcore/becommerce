<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/9/2022
 * Time: 8:42 AM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Product\Models\ProductCategory;
use Modules\Template\Blocks\BaseBlock;

class CategoryProduct extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title_name',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                    ]
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('Slider Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'      => 'category_id',
                            'type'    => 'select2',
                            'label'   => __('Select Category'),
                            'select2' => [
                                'ajax'  => [
                                    'url'      => route('product.admin.category.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'width' => '100%',
                                'allowClear' => 'true',
                                'placeholder' => __('-- Select --')
                            ],
                            'pre_selected'=>route('product.admin.category.getForSelect2',['pre_selected'=>1])
                        ],
                        [
                            'id'    => 'icon',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Icon ')
                        ],
                    ]
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Category Product');
    }

    public function content($model = [])
    {
        if(!empty($model['list_items'])){
            $ids = collect($model['list_items'])->pluck('category_id');
            $categories = ProductCategory::query()->whereIn("id",$ids)->get();
            $model['categories'] = $categories;
        }
        $style = $model['style'] ? $model['style'] : 'index';
        return view("blocks.category.{$style}", $model);
    }
}
